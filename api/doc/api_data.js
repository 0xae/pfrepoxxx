define({ "api": [
  {
    "type": "get",
    "url": "http://XXX.X.X.X/casa_cidadao/api/list/guiaservico",
    "title": "Request List Guia de Serviso",
    "name": "Obter_List_Guia_de_Serviso",
    "group": "Guia_de_Servico",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>Codigo do Retorno.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_message",
            "description": "<p>Mensagem Confirmacao.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>Lista de Objecto (JSonArray).</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "idcategory",
            "description": "<p>Id Unico Da Categorio (Identificador).</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "number",
            "description": "<p>Codigo de organizacao da Categoria</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Nome representativo da Categoria.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "image",
            "description": "<p>Imagen/Icon da Categoria.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "color",
            "description": "<p>Cor representativo de Categoria na Tela.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Descricao da Categoria.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "         {\n    \"status\": 200,\n    \"status_message\": \"List Guia Found\",\n    \"data\": [\n        {\n            \"idcategory\": \"1\",\n            \"number\": \"1\",\n            \"name\": \"Nascimento e Identificação\",\n            \"image\": \"uploads/category/yV5371TXpup2eqW_RBXijANCgC0DQY2U.png\",\n            \"color\": \"#f8a044\",\n            \"description\": \"O nascimento representa o princípio da vida e a esperança do futuro.\",\n            \"status\": \"1\"\n        },\n        {\n            \"idcategory\": \"2\",\n            \"number\": \"2\",\n            \"name\": \"Educação e Formação\",\n            \"image\": \"uploads/category/8ixBDI85duB558VnfJrJU85rQ7XljJ8p.png\",\n            \"color\": \"#13af13\",\n            \"description\": \"“A educação é o grande motor do desenvolvimento pessoal. É através dela que a filha de um camponês se torna médica, que o filho de um mineiro pode chegar a chefe de mina, que um filho de trabalhadores rurais pode chegar a presidente de uma grande nação.” - Nelson Mandela\",\n            \"status\": \"1\"\n        },\n        {\n            \"idcategory\": \"3\",\n            \"number\": \"3\",\n            \"name\": \"Emprego e Voluntariado\",\n            \"image\": \"uploads/category/P6bWVrqrIlQn2Xgp1a3R3V8Q20W9HA8J.png\",\n            \"color\": \"#6a98e2\",\n            \"description\": \"A redução do desemprego e a pobreza constituem-se como os grandes desafios para Cabo Verde. Quer-se promover “um crescimento económico forte e sustentável, baseado na combinação ótima entre o aumento do volume dos investimentos e da produtividade” que, consequentemente, contribua para a redução do desemprego e a pobreza.\",\n            \"status\": \"1\"\n        },\n        {\n            \"idcategory\": \"4\",\n            \"number\": \"4\",\n            \"name\": \"Família e Habitação\",\n            \"image\": \"uploads/category/XEypFdWvuAjBSds-Hia7QzmRhjtMjPu-.png\",\n            \"color\": \"#ff0000\",\n            \"description\": \"“O sonho de cada família é poder viver junta e feliz, num lar tranquilo e pacífico, em que os pais têm oportunidade de criar os filhos da melhor maneira possível, ou de orientá-los e ajudar a escolher as suas carreiras, dando-lhes o amor e carinho que desenvolverá neles um sentimento de segurança e de autoconfiança” – Nelson Mandela in “Carta a Zindzi Mandela (1970)”\",\n            \"status\": \"1\"\n        },\n        {\n            \"idcategory\": \"5\",\n            \"number\": \"5\",\n            \"name\": \"Saúde e Serviços Médicos\",\n            \"image\": \"uploads/category/3reSv5iuR2OTK1ncknzxiyAGOlNnG5vc.png\",\n            \"color\": \"#732110\",\n            \"description\": \"A saúde é um bem essencial por isso preserve-o!\\r\\nDoar sangue é dar vida.\",\n            \"status\": \"1\"\n        }\n    ]\n}",
          "type": "json"
        },
        {
          "title": "Response-Empty:",
          "content": "{\n    \"status\": 200,\n    \"status_message\": \"List Guia not Found\",\n    \"data\": \"null\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./generateAPI.php",
    "groupTitle": "Guia_de_Servico",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>Page Not Found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Restrict",
            "description": "<p>User nao Tem acesso a esta funcionalidade.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Erro-Interno",
            "description": "<p>Erro Interno do Servidor.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not-Found:",
          "content": " HTTP/1.1 404 Not Found\n {\n   \"status\": 404,\n \"status_message\": \"page not found 404\",\n \"data\": \"null\"\n}",
          "type": "json"
        },
        {
          "title": "Restric-Acess:",
          "content": " HTTP/1.1 403 Acesso negado\n {\n   \"status\": 403,\n \"status_message\": \"Acesso negado  403\",\n \"data\": \"null\"\n}",
          "type": "json"
        },
        {
          "title": "Erro-Interno:",
          "content": " HTTP/1.1 500 Intern Error\n {\n   \"status\": 500,\n \"status_message\": \"Erro Interno de Servidor 500\",\n \"data\": \"null\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "http://XXX.X.X.X/casa_cidadao/api/subtopic/topico/:id_topic",
    "title": "Request SubTopicos de um Topicos",
    "name": "Obter_Lista_de_Todos_os_SUB_Topicos__descrisao__iten_de_um_determinado_do_Topico",
    "group": "Guia_de_Servico",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id_topic",
            "description": "<p>ID identificador do Topico desejado.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>Codigo do Retorno.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_message",
            "description": "<p>Mensagem Confirmacao.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>Lista de Objecto (JSonArray).</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "idsubtopic",
            "description": "<p>Id Unico Do SubTopico (Identificador).</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "topic_category_idcategory",
            "description": "<p>Id da Categoria relacionada ao Topico do SubTopico</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "topic_idtopic",
            "description": "<p>ID do Topico relacionado ao SUbTopico</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Nome do referido SubTopico.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "localizacao_idlocalizacao",
            "description": "<p>Localizacao do SubTopico em Coordenada (latitude;longitude).</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "description",
            "description": "<p>Array com todos as informacao do SubTOpico.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "iddescription",
            "description": "<p>Id Unico pertencente a descricao (Array) do SubTopico</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subtopic_idsubtopic",
            "description": "<p>ID do SUbTopico</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "iten",
            "description": "<p>Array com todos os Iten do subtopico/ pontos do subtopico</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "iddetail",
            "description": "<p>Id unico do detalhe do Iten do SubTopico</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "description_iddescription",
            "description": "<p>ID perterncete a que descricao o Item pertence</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " {\n    \"status\": 200,\n    \"status_message\": \"List Topics Found\",\n    \"data\": [\n        {\n            \"idsubtopic\": \"1\",\n            \"topic_category_idcategory\": \"1\",\n            \"topic_idtopic\": \"1\",\n            \"name\": \"Como obter orientação médica?\",\n            \"localizacao_idlocalizacao\": null,\n            \"status\": \"1\",\n            \"description\": [\n                {\n                    \"iddescription\": \"1\",\n                    \"subtopic_idsubtopic\": \"1\",\n                    \"description\": \"dfgdfgdfgdfgdfgdfgdfgdfgfd\",\n                    \"status\": \"1\",\n                    \"iten\": [\n                        {\n                            \"iddetail\": \"1\",\n                            \"description_iddescription\": \"1\",\n                            \"description\": \"wfeeererer\",\n                            \"status\": null\n                        },\n                        {\n                            \"iddetail\": \"2\",\n                            \"description_iddescription\": \"1\",\n                            \"description\": \"sdfdfgfdgdfgdfg\",\n                            \"status\": null\n                        }\n                    ]\n                }\n            ]\n        },\n        {\n            \"idsubtopic\": \"2\",\n            \"topic_category_idcategory\": \"1\",\n            \"topic_idtopic\": \"1\",\n            \"name\": \"Como obter o subsídio de aleitamento?\",\n            \"localizacao_idlocalizacao\": null,\n            \"status\": \"1\",\n            \"description\": []\n        }\n    ]\n}",
          "type": "json"
        },
        {
          "title": "Response-Empty:",
          "content": "{\n    \"status\": 200,\n    \"status_message\": \"List SubTopics not Found\",\n    \"data\": \"null\"\n}",
          "type": "json"
        }
      ]
    },
    "description": "<p>This is the Description. It is multiline capable.</p> <p>Last line of Description.</p>",
    "version": "0.0.0",
    "filename": "./generateAPI.php",
    "groupTitle": "Guia_de_Servico",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>Page Not Found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Restrict",
            "description": "<p>User nao Tem acesso a esta funcionalidade.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Erro-Interno",
            "description": "<p>Erro Interno do Servidor.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not-Found:",
          "content": " HTTP/1.1 404 Not Found\n {\n   \"status\": 404,\n \"status_message\": \"page not found 404\",\n \"data\": \"null\"\n}",
          "type": "json"
        },
        {
          "title": "Restric-Acess:",
          "content": " HTTP/1.1 403 Acesso negado\n {\n   \"status\": 403,\n \"status_message\": \"Acesso negado  403\",\n \"data\": \"null\"\n}",
          "type": "json"
        },
        {
          "title": "Erro-Interno:",
          "content": " HTTP/1.1 500 Intern Error\n {\n   \"status\": 500,\n \"status_message\": \"Erro Interno de Servidor 500\",\n \"data\": \"null\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "http://XXX.X.X.X/casa_cidadao/api/topicos/categoria/:id_categoria",
    "title": "Request  Topicos da Categoria",
    "name": "Obter_Lista_de_Todos_os_Topicos_da_Categoria_Selecionada",
    "group": "Guia_de_Servico",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id_categoria",
            "description": "<p>ID identificador da Categoria desejada.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>Codigo do Retorno.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_message",
            "description": "<p>Mensagem Confirmacao.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>Lista de Objecto (JSonArray).</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "idtopic",
            "description": "<p>Id Unico Do Topico (Identificador).</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category_idcategory",
            "description": "<p>Id da Categoria relacionada ao Topico</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "number",
            "description": "<p>Numero representante a order de organizacao</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Nome do referido Topico.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "image",
            "description": "<p>Image representativo ao Topico.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Descricao representativo ao Topico.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " {\n    \"status\": 200,\n    \"status_message\": \"List Topics Found\",\n    \"data\": [\n        {\n            \"idtopic\": \"1\",\n            \"category_idcategory\": \"1\",\n            \"number\": \"1.1\",\n            \"name\": \"Estou grávida e o nosso filho(a) vai nascer\",\n            \"image\": \"uploads/topic/CaesQNHKGstUWQ8j9k-xrQfbNWliwb1C.png\",\n            \"description\": \"A gravidez é uma etapa importante na vida dos pais e de toda a família. Mas, também é uma etapa que merece muitos cuidados com a mãe e o bebé para que tudo corra bem e a recuperação seja a melhor.\",\n            \"status\": \"1\"\n        },\n        {\n            \"idtopic\": \"2\",\n            \"category_idcategory\": \"1\",\n            \"number\": \"1.2\",\n            \"name\": \"Quero registar o meu filho\",\n            \"image\": \"uploads/topic/jDRnRpQEP5StYLQUkTWh6c-fZRMvXy8M.png\",\n            \"description\": \"Todo o cidadão tem direito a um registo de nascimento e, através dele provar a sua identidade.\",\n            \"status\": \"1\"\n        },\n        {\n            \"idtopic\": \"3\",\n            \"category_idcategory\": \"1\",\n            \"number\": \"1.3\",\n            \"name\": \"Quero obter uma cédula pessoal\",\n            \"image\": \"uploads/topic/UakUKx8j2xva7Jsp0DQJIfziXlnJvZJT.png\",\n            \"description\": \"Cédula pessoal é um comprovativo do registo de nascimento de uma criança, entregue logo após o ato do registo.\",\n            \"status\": \"1\"\n        }\n    ]\n}",
          "type": "json"
        },
        {
          "title": "Response-Empty:",
          "content": "{\n    \"status\": 200,\n    \"status_message\": \"List Topics not Found\",\n    \"data\": \"null\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./generateAPI.php",
    "groupTitle": "Guia_de_Servico",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>Page Not Found.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Restrict",
            "description": "<p>User nao Tem acesso a esta funcionalidade.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Erro-Interno",
            "description": "<p>Erro Interno do Servidor.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not-Found:",
          "content": " HTTP/1.1 404 Not Found\n {\n   \"status\": 404,\n \"status_message\": \"page not found 404\",\n \"data\": \"null\"\n}",
          "type": "json"
        },
        {
          "title": "Restric-Acess:",
          "content": " HTTP/1.1 403 Acesso negado\n {\n   \"status\": 403,\n \"status_message\": \"Acesso negado  403\",\n \"data\": \"null\"\n}",
          "type": "json"
        },
        {
          "title": "Erro-Interno:",
          "content": " HTTP/1.1 500 Intern Error\n {\n   \"status\": 500,\n \"status_message\": \"Erro Interno de Servidor 500\",\n \"data\": \"null\"\n}",
          "type": "json"
        }
      ]
    }
  }
] });
