# Observações

1. Decisão da arquitetura utilizada

    - Foi adotado os princípios do SOLID.
    - Mantido a estrutura padrão do Laravel, acrescentando outros diretórios com suas responsabilidades.
    - Por questão de segurança, foi utilizado a dependência `goldspecdigital/laravel-eloquent-uuid` para gerar UUID para o id, em vez do auto-increment
    - Foi utilizado a dependência `flugger/laravel-responder` que possibilita utilizar transformers no models e estruturar o retorno dos recursos.
    - Extendido o Form Request para que possibilite a "transformar" o retorno da validação. Sendo assim, para mantemos o padrão de estrutura de saída do `flugger/laravel-responder`
    - Utilizado Git Flow para manter o padrão de commits e tags.

2. Lista de bibliotecas de terceiros utilizadas

    - `goldspecdigital/laravel-eloquent-uuid` gerar UUID para o id
    - `flugger/laravel-responder` implementar o retorno dos recursos

3. O que você melhoraria se tivesse mais tempo

    - Implementar autenticação
    - Utilizar o Docker
    - Testes mais detalhado

4. Quais requisitos obrigatórios que não foram entregues

Todos os requisitos entregues.
