---------------------------------------------
Biblioteca de integração PagSeguro em PHP
v2.1.4
---------------------------------------------


= Descrição =

A biblioteca PagSeguro em PHP é um conjunto de classes de domínio que facilitam, para o desenvolvedor PHP, a utilização das funcionalidades que o PagSeguro oferece na forma de APIs. Com a biblioteca instalada e configurada, você pode facilmente integrar funcionalidades como:

	- Criar requisições de pagamentos
	- Consultar transações por código
	- Consultar transações por intervalo de datas
	- Consultar transações abandonadas
	- Receber notificações


= Requisitos =

	- PHP 5.1.6+
	- SPL
	- cURL
	- DOM


= Instalação =


	- Faça o download da Biblioteca PagSeguro em PHP;
	- Descompacte os arquivos em seu computador;
	- Dentro do diretório 'source' existem dois diretórios, o 'examples' e o 'PagSeguroLibrary'. O diretório 'examples' contém exemplos de chamadas utilizando a API e o diretório 'PagSeguroLibrary' contém a biblioteca propriamente dita. Caso queira importar somente a biblioteca, faça upload do diretório 'PagSeguroLibrary' e inclua a classe 'PagSeguroLibrary.php' em seu projeto. Essa classe se encarregará de importar todas as funcionalidades da biblioteca no seu sistema.


= Configuração =

Para fazer uso real da biblioteca é preciso fazer algumas configurações no arquivo 'PagSeguroConfig.php', que encontra-se no diretório 'config'. As opções disponíveis estão descritas abaixo.

	- environment: no momento aceita apenas o valor "production"
	- email: e-mail cadastrado no PagSeguro
	- token: token gerado no PagSeguro
	- charset: codificação do seu sistema (ISO-8859-1 ou UTF-8)
	- log: ativa/desativa a geração de logs
	- fileLocation: local onde se deseja criar o arquivo de log. Ex.: /logs/ps.log

	Informações adicionais podem ser obtidas em: https://pagseguro.uol.com.br/v2/guia-de-integracao/tutorial-da-biblioteca-pagseguro-em-php.html


= Changelog =

	v2.1.4

	- Adicionado: Classe para manipulação de moedas permitidas nas transações com o PagSeguro

	v2.1.3

	- Correção: A requisição era abortada se a geração de log estivesse ativa e o usuário não possuisse arquivo para geração de log nem permissão de escrita e leitura para o arquivo

	v2.0.0 - v2.1.2

	- Classes de domínios que representam pagamentos, notificações e transações
	- Criação de checkouts via API
	- Controller para processar notificações de pagamento enviadas pelo PagSeguro
	- Módulo de consulta de transações


= Notas =

	- Certifique-se que o email e o token informados estejam relacionados a uma conta que possua o perfil de vendedor ou empresarial.
	- Certifique-se que tenha definido corretamente o charset de acordo com a codificação (ISO-8859-1 ou UTF-8) do seu sistema. Isso irá prevenir que as transações gerem possíveis erros ou quebras ou ainda que caracteres especiais possam ser apresentados de maneira diferente do habitual.
	- Para que ocorra normalmente a geração de logs, certifique-se que o diretório e o arquivo de log tenham permissões de leitura e escrita.
	- Dúvidas? https://pagseguro.uol.com.br/desenvolvedor/comunidade.jhtml
