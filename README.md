# Sueldo Quincenal

Aplicación web en PHP que calcula el sueldo quincenal de un trabajador según las horas trabajadas en tres turnos.

## Estructura

sueldo-quincenal/
├── index.html
├── css/
│   └── estilos.css
├── php/
│   └── calcular.php
└── README.md


## Funcionamiento

1. `index.html` muestra un formulario con nombre, cédula y horas diurnas, vespertinas y nocturnas.
2. `php/calcular.php` recibe los datos y calcula el sueldo bruto con las tarifas:
   * Diurna: 675 Bs./h
   * Vespertina: 700 Bs./h
   * Nocturna: 956.23 Bs./h
3. Segun el sueldo bruto se aplican los porcentajes de retención:

| Sueldo bruto   | Ahorro Habitacional | Seguro Social |

| Menor a 85.000      | 0,1 %  | 0,15 % |
| De 85.000 a 150.000 | 0,15 % | 0,2 %  |
| Mayor a 150.000     | 0,3 %  | 0,25 % |

4. Se muestran los datos del empleado, el sueldo bruto, cada descuento y el sueldo neto.

