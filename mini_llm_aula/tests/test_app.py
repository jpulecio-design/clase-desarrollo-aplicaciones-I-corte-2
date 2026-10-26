"""Pruebas locales: no requieren red externa ni credenciales."""
import importlib.util
import json
from pathlib import Path
import threading
import unittest
from unittest.mock import patch
from urllib.error import HTTPError
from urllib.request import Request, urlopen
from http.server import ThreadingHTTPServer

P = Path(__file__).resolve().parents[1] / 'backend' / 'app.py'
spec = importlib.util.spec_from_file_location('teaching_backend', P)
app = importlib.util.module_from_spec(spec)
spec.loader.exec_module(app)


class TestAPI(unittest.TestCase):
    @classmethod
    def setUpClass(cls):
        cls.server = ThreadingHTTPServer(('127.0.0.1', 0), app.Handler)
        cls.port = cls.server.server_address[1]
        cls.thread = threading.Thread(target=cls.server.serve_forever, daemon=True)
        cls.thread.start()

    @classmethod
    def tearDownClass(cls):
        cls.server.shutdown()
        cls.server.server_close()

    def test_health(self):
        with urlopen(f'http://127.0.0.1:{self.port}/api/health') as res:
            value = json.load(res)
        self.assertEqual(value['status'], 'ok')

    def test_frontend(self):
        with urlopen(f'http://127.0.0.1:{self.port}/') as res:
            page = res.read().decode()
        self.assertIn('Tu primera IA conectada', page)

    def test_roundtrip_demo(self):
        with patch.object(app, 'PROVIDER', 'demo'):
            req = Request(f'http://127.0.0.1:{self.port}/api/chat',
                          data=json.dumps({'message': 'Hola'}).encode(),
                          headers={'Content-Type':'application/json'},method='POST')
            with urlopen(req) as res:
                result = json.load(res)
        self.assertTrue(result['simulated'])
        self.assertEqual(result['provider'], 'demo')

    def test_reject_empty(self):
        req = Request(f'http://127.0.0.1:{self.port}/api/chat',
                      data=b'{"message": ""}',headers={'Content-Type':'application/json'},method='POST')
        with self.assertRaises(HTTPError) as cm:
            urlopen(req)
        self.assertEqual(cm.exception.code, 422)

    def test_provider_parser_openrouter(self):
        with patch.object(app, 'PROVIDER', 'openrouter'), patch.dict('os.environ', {'OPENROUTER_API_KEY':'not-a-real-key'}), patch.object(app, 'post_json', return_value={
          'model':'proveedor-prueba', 'choices':[{'finish_reason':'stop', 'message':{'content':'Respuesta de prueba'}}],
          'usage':{'prompt_tokens':10,'completion_tokens':8}}):
            result=app.infer('Hola')
        self.assertEqual(result['answer'], 'Respuesta de prueba')
        self.assertFalse(result['simulated'])

    def test_provider_parser_ollama(self):
        with patch.object(app, 'PROVIDER', 'ollama'), patch.object(app, 'post_json', return_value={
           'model':'modelo-prueba','message':{'content':'Respuesta local'},'prompt_eval_count':15,'eval_count':8}):
            result=app.infer('Hola')
        self.assertEqual(result['answer'], 'Respuesta local')


if __name__ == '__main__':
    unittest.main(verbosity=2)
