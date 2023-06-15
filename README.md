# Registro de namespaces del SAT

Como no existe un registro general de los XML Namespaces que utiliza el SAT, he creado este repositorio
que cuenta con el archivo [`complementos_v1.json`](complementos_v1.json) en donde he recopilado la
información de la documentación técnica.

## Estructura versión 1

El archivo contiene un listado con objetos con las siguientes propiedades:

```json
    {
        "description": "Recepción de pagos",
        "docUrl": "https://www.sat.gob.mx/consultas/92764/comprobante-de-recepcion-de-pagos",
        "element": "Pagos",
        "version": "1.0",
        "prefix": "pago10",
        "namespace": "http://www.sat.gob.mx/Pagos",
        "xsd": "http://www.sat.gob.mx/sitio_internet/cfd/Pagos/Pagos10.xsd",
        "xslt": "http://www.sat.gob.mx/sitio_internet/cfd/Pagos/Pagos10.xslt",
        "type": "Complemento"
    }
```

## Versionado

Con la idea de SEMVER se implementan este manejo de versiones `mayor.menor.fix`

- Si cambia la estructura de los objetos entonces se cambia a la siguiente versión mayor.
- Si se agregan nuevas propiedades a los objetos pero la estructura sigue siendo compatible entonces se cambia la versión menor.
- Si solo se agregan o eliminan objetos entonces cambia la versión menor.
- Si solo se hace alguna corrección entonces cambia la versión fix.

## Mantenimiento

Si la información publicada es incorrecta o desactualizada por favor llena un *Issue* con todos los datos posibles.
Si cuentas con la corrección podrías hacer un *Pull Request*.

Internamente uso un archivo CSV y un script simple de PHP para generar el contenido JSON. Ambos están en la carpeta `source/`.

## Licencia

Esta obra está licenciada bajo la Licencia Creative Commons Atribución 4.0 Internacional. Para ver una copia de esta licencia, visite <http://creativecommons.org/licenses/by/4.0/> o envíe una carta a Creative Commons, PO Box 1866, Mountain View, CA 94042, USA.

This work is licensed under the Creative Commons Attribution 4.0 International License. To view a copy of this license, visit <http://creativecommons.org/licenses/by/4.0/> or send a letter to Creative Commons, PO Box 1866, Mountain View, CA 94042, USA.
