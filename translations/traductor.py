import re
from googletrans import Translator

# Nombre del archivo PHP original (ruta completa)
input_filename = r'C:\Users\bryle\OneDrive\Documentos\Project-Web\Proyecto\Creditos\translations\es.php'
# Nombre del nuevo archivo PHP traducido (ruta completa)
output_filename = r'C:\Users\bryle\OneDrive\Documentos\Project-Web\Proyecto\Creditos\translations\en.php'

# Leer el archivo PHP
with open(input_filename, 'r', encoding='utf-8') as file:
    content = file.read()

# Extraer los pares clave-valor usando una expresión regular
pattern = re.compile(r"'(\w+)' => '([^']*)'")
matches = pattern.findall(content)

# Crear un diccionario de Python a partir de los pares clave-valor
data = {key: value for key, value in matches}

# Inicializar el traductor
translator = Translator()

# Traducir los valores del diccionario
translated_data = {}
for key, value in data.items():
    translated_value = translator.translate(value, src='es', dest='en').text
    translated_data[key] = translated_value

# Generar el nuevo contenido del archivo PHP traducido
translated_content = "<?php\nreturn [\n"
for key, value in translated_data.items():
    translated_content += f"    '{key}' => '{value}',\n"
translated_content += "];\n"

# Escribir el contenido traducido en un nuevo archivo PHP
with open(output_filename, 'w', encoding='utf-8') as file:
    file.write(translated_content)

print(f"Traducción completada y guardada en '{output_filename}'.")
