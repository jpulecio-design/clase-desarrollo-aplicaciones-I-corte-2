const send = document.getElementById('send');
const message = document.getElementById('message');
const answer = document.getElementById('answer');
const metadata = document.getElementById('metadata');
const state = document.getElementById('state');

async function loadHealth() {
  try {
    const response = await fetch('/api/health');
    if (!response.ok) throw new Error('Servidor no disponible');
    const data = await response.json();
    state.textContent = `${data.is_demo ? 'MODO SIMULADO · NO ES IA REAL' : 'PROVEEDOR REAL'} | ${data.provider} | ${data.model}`;
  } catch (error) { state.textContent = 'No se pudo consultar /api/health'; }
}

async function ask() {
  const text = message.value.trim();
  if (!text) { answer.textContent = 'Escribe una pregunta.'; return; }
  send.disabled = true;
  answer.textContent = 'Consultando al backend…'; metadata.textContent = '';
  try {
    // La API se llama en el MISMO origen. No hay CORS ni claves API en el navegador.
    const response = await fetch('/api/chat', {
      method: 'POST', headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ message: text })
    });
    const data = await response.json();
    if (!response.ok) throw new Error(data.error || `HTTP ${response.status}`);
    answer.textContent = data.answer; // textContent evita interpretar HTML del LLM.
    metadata.textContent = `Proveedor: ${data.provider} · Modelo: ${data.model} · Tiempo: ${data.elapsed_seconds}s · Tokens: ${data.tokens_in ?? 'N/D'}/${data.tokens_out ?? 'N/D'}${data.simulated ? ' · SIMULACIÓN' : ''}`;
  } catch (error) {
    answer.textContent = `Error: ${error.message}`;
  } finally { send.disabled = false; }
}

send.addEventListener('click', ask);
loadHealth();
