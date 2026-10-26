# Taller LogicLoop: conectar un LLM a una web (mínimo funcional)

**Objetivo:** aprender el flujo `HTML/CSS/JS → Python (HTTP) → modelo de IA → respuesta` y observar lo ocurrido en consola. Este es un **proyecto didáctico independiente**, no el código de producción de LogicLoop. No ejecuta pseudocódigo LPP ni equivale a un validador de sintaxis real.

## 1. Estructura

```
mini_llm_aula/
├─ backend/app.py                # Servidor y conector de IA
├─ frontend/index.html           # Interfaz
├─ frontend/styles.css           # Aspecto visual
├─ frontend/app.js               # Petición fetch() y respuesta
├─ .env.example                  # Configuración de ejemplo, SIN credenciales
├─ .gitignore                    # Impide subir .env
├─ ejemplos/                     # Preguntas LPP y plantilla de evaluación
└─ tests/test_app.py             # Pruebas reproducibles, sin red externa
```

**Requisitos:** Python 3.10 o superior; navegador. Solo si se escoge Ollama, instalar [Ollama](https://ollama.com/). Solo si se escoge OpenRouter, tener cuenta y API key en [OpenRouter](https://openrouter.ai/). No hace falta `pip install`.

## 2. Iniciar por primera vez en Windows / PowerShell

Abre una terminal en `mini_llm_aula`:

```powershell
Copy-Item .env.example .env
py -3 backend/app.py
```

Si `py -3` no funciona, usa `python backend/app.py`. Abre **http://localhost:8080**. Escribe una pregunta, pulsa **Enviar al backend** y mira la consola de Python. Aparecerán la petición, el proveedor, la duración y una muestra de la respuesta.

**Importante:** la configuración inicial `AI_PROVIDER=demo` **no usa ninguna inteligencia artificial**. Emite una respuesta simulada para que el profesor pueda demostrar, sin Internet ni cuentas, que HTML, JavaScript y Python se están comunicando correctamente. La interfaz indica explícitamente que es una simulación.

## 3. Alternativa A: IA local con Ollama

1. Instala Ollama desde su sitio oficial.
2. Abre una consola y ejecuta:

```powershell
ollama pull llama3.2:1b
ollama list
```

3. Comprueba que Ollama esté ejecutándose. En algunas instalaciones se inicia automáticamente; si no, ejecuta `ollama serve` en otra terminal.
4. Edita tu `.env` (**no el `.env.example`**):

```dotenv
AI_PROVIDER=ollama
AI_MODEL=llama3.2:1b
APP_PORT=8080
```

5. Reinicia Python con `Ctrl+C` y `py -3 backend/app.py`. Prueba otra vez en **http://localhost:8080**.

**Ventajas:** uso local y posibilidad de trabajar sin Internet tras descargar el modelo. **Limitaciones:** ocupa RAM/almacenamiento; la velocidad depende del equipo y un modelo pequeño puede fallar en tareas especializadas (como LPP).

## 4. Alternativa B: API de OpenRouter

1. Crea una API key en OpenRouter. **No la envíes por chat, correo ni la publiques.**
2. Edita `.env`:

```dotenv
AI_PROVIDER=openrouter
AI_MODEL=nvidia/nemotron-3-ultra-550b-a55b:free
OPENROUTER_API_KEY=REEMPLAZA_LOCALMENTE_CON_TU_CLAVE
APP_PORT=8080
AI_TIMEOUT=90
```

3. Reinicia Python y prueba. El identificador de NVIDIA es el observado en LogicLoop en octubre de 2026; confirma que esté disponible en el [catálogo de OpenRouter](https://openrouter.ai/models) cuando hagas la clase. Puedes cambiar `AI_MODEL` por el identificador de otro modelo de chat compatible.

**Ventajas:** no necesitas alojar los pesos del modelo. **Limitaciones:** Internet, privacidad, disponibilidad, cuotas y precios o límites variables. El modelo gratuito puede tener restricciones y la ruta API no es garantía de funcionamiento continuo.

## 5. ¿Qué sucede exactamente?

1. El alumno escribe una pregunta en `index.html`.
2. `app.js` envía `POST /api/chat` con JSON: `{"message":"..."}` mediante `fetch()`.
3. `backend/app.py` valida la entrada y selecciona el proveedor definido en `.env`.
4. Si el modo es `ollama` o `openrouter`, Python construye los mensajes `system` y `user` y realiza una petición HTTP al modelo.
5. Python extrae el texto de la respuesta; muestra registros en consola y devuelve un JSON unificado.
6. JavaScript coloca el texto en `textContent`, junto con proveedor, modelo y duración.

**¿Por qué no se llama OpenRouter desde JavaScript del navegador?** La API key quedaría visible y sería fácil de robar. En este taller solo Python guarda y utiliza la clave. Para desplegar una aplicación pública hacen falta autenticación, límites por usuario, almacenamiento seguro de secretos, HTTPS y monitoreo.

## 6. Probar la app sin gastar cuota

```powershell
py -3 -m unittest discover -s tests -v
```

Las pruebas comprueban la ruta de salud, carga de HTML, viaje JSON extremo a extremo en **modo simulado**, rechazo de mensajes vacíos y lectura de **respuestas de proveedor simuladas en memoria** para los adaptadores de Ollama/OpenRouter. **Estas pruebas NO demuestran que un LLM real esté disponible o responda correctamente**. La inferencia real depende de tu equipo, configuración, Internet y clave API, y deberá verificarse durante el taller.

## 7. Tarea: transformar este demo en un asistente enfocado en su proyecto

**Fase 1 — Delimitar:** escribe a quién ayuda (ej. estudiantes LPP), qué preguntas permite, qué se niega a inventar y cómo verificará respuestas.

**Fase 2 — Contextualizar:** modifica `SYSTEM_PROMPT` en `backend/app.py` para establecer rol, dominio, audiencia, restricciones y formato deseado. Cambiar un prompt es configuración de comportamiento; **no es entrenar el modelo**.

**Fase 3 — Añadir conocimiento:** incorpora un manual, reglamento o lista de reglas validada. Si crece el contenido, implementa recuperación de documentos (RAG) en vez de pegar siempre todo el libro en el prompt. No envíes datos personales sin autorización.

**Fase 4 — Crear acciones (solo si son necesarias):** integrar APIs de consulta, una base de datos de ejercicios o un analizador determinista del código. Un LLM que solo responde preguntas **no es automáticamente un agente con herramientas**; un agente necesita objetivos/acciones delimitados, control y verificación.

**Fase 5 — Evaluar:** crea una tabla de 20-50 casos con respuestas esperadas y errores conocidos, compara modelos manteniendo iguales los prompts y parámetros, registra falsos positivos, falsos negativos, latencia, costos y tasa de formato válido. Empieza con `ejemplos/benchmark_plantilla.csv`. Un HTTP 200 o un JSON válido **no prueba exactitud del resultado**.

**Fase 6 — Fortalecer:** valida entradas, separa reglas del lenguaje del generador de explicaciones, gestiona errores HTTP 401/402/429/502/503, usa logs prudentes, limita respuestas y llamadas, añade caché para consultas repetidas y guarda pruebas de regresión. Para LPP: validar la sintaxis con una lógica comprobable y usar el LLM para explicar errores es más fiable que delegar todo el juicio a la IA.

### Desafío en clase (15 minutos)

- Cambia la personalidad pedagógica y explica a qué proyecto se orienta.
- Prueba una consulta correcta, una pregunta ambigua y una petición que el modelo debería reconocer que desconoce.
- Ejecuta Ollama **o** OpenRouter y enseña en pantalla la petición, la respuesta y la consola Python.
- Comparte **solo el código**, nunca la `.env` ni claves.

## 8. Diagnóstico de errores habituales

| Señal | Qué revisar |
|---|---|
| `401` o `403` del proveedor | API key, permisos o configuración; no pegar la clave en capturas. |
| `402` o `429` | Crédito/cuota/límite de solicitudes del proveedor; no repetir compulsivamente. |
| `503` en la página | Python no alcanzó el proveedor o la configuración es incorrecta. |
| No carga `localhost:8080` | Verifica que Python está ejecutándose y el puerto no está ocupado. |
| Ollama dice `model not found` | Ejecuta `ollama pull <modelo>` y comprueba `ollama list`. |
| Respuesta incorrecta, aunque HTTP 200 | Es un problema de **calidad del LLM o del contexto**, no de conexión. |

## Fuentes (documentación oficial)

- https://openrouter.ai/docs/api/api-reference/chat/send-chat-completion-request
- https://openrouter.ai/pricing
- https://docs.ollama.com/api/chat

**Advertencia:** no publiques archivos `.env` del proyecto original. Si una clave se compartió, revócala y genera una nueva.
