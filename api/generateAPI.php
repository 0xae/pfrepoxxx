<?php
/**
 * @apiDefine UserNotFoundError
 *
 * @apiError UserNotFound Page Not Found.
 *
 * @apiErrorExample Not-Found:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "status": 404,
 *     "status_message": "page not found 404",
 *     "data": "null"
 *    }
 *
 * @apiError Restrict User nao Tem acesso a esta funcionalidade.
 *
 * @apiErrorExample Restric-Acess:
 *     HTTP/1.1 403 Acesso negado
 *     {
 *       "status": 403,
 *     "status_message": "Acesso negado  403",
 *     "data": "null"
 *    }
 *
 * @apiError Erro-Interno Erro Interno do Servidor.
 *
 * @apiErrorExample Erro-Interno:
 *     HTTP/1.1 500 Intern Error
 *     {
 *       "status": 500,
 *     "status_message": "Erro Interno de Servidor 500",
 *     "data": "null"
 *    }
 */

/**
 * @api {get} http://XXX.X.X.X/casadocidadao/api/list/guiaservico Request List Guia de Serviso
 * @apiName Obter List Guia de Serviso
 * @apiGroup Guia de Servico
 *
 *
 * @apiSuccess {Number} status Codigo do Retorno.
 * @apiSuccess {String} status_message Mensagem Confirmacao.
 * @apiSuccess {String} data Lista de Objecto (JSonArray).
 * @apiSuccess {Number} idcategory Id Unico Da Categorio (Identificador).
 * @apiSuccess {Number} number Codigo de organizacao da Categoria
 * @apiSuccess {String} name Nome representativo da Categoria.
 * @apiSuccess {String} image Imagen/Icon da Categoria.
 * @apiSuccess {String} color Cor representativo de Categoria na Tela.
 * @apiSuccess {String} description Descricao da Categoria.
 * @apiSuccess {Number} status Estado da Categoria (0-Indesponivel, 1-Desponivel).
 *
 * @apiSuccessExample Success-Response:
 *          {
    "status": 200,
    "status_message": "List Guia Found",
    "data": [
        {
            "idcategory": "1",
            "number": "1",
            "name": "Nascimento e Identificação",
            "image": "uploads/category/yV5371TXpup2eqW_RBXijANCgC0DQY2U.png",
            "color": "#f8a044",
            "description": "O nascimento representa o princípio da vida e a esperança do futuro.",
            "status": "1"
        },
        {
            "idcategory": "2",
            "number": "2",
            "name": "Educação e Formação",
            "image": "uploads/category/8ixBDI85duB558VnfJrJU85rQ7XljJ8p.png",
            "color": "#13af13",
            "description": "“A educação é o grande motor do desenvolvimento pessoal. É através dela que a filha de um camponês se torna médica, que o filho de um mineiro pode chegar a chefe de mina, que um filho de trabalhadores rurais pode chegar a presidente de uma grande nação.” - Nelson Mandela",
            "status": "1"
        },
        {
            "idcategory": "3",
            "number": "3",
            "name": "Emprego e Voluntariado",
            "image": "uploads/category/P6bWVrqrIlQn2Xgp1a3R3V8Q20W9HA8J.png",
            "color": "#6a98e2",
            "description": "A redução do desemprego e a pobreza constituem-se como os grandes desafios para Cabo Verde. Quer-se promover “um crescimento económico forte e sustentável, baseado na combinação ótima entre o aumento do volume dos investimentos e da produtividade” que, consequentemente, contribua para a redução do desemprego e a pobreza.",
            "status": "1"
        },
        {
            "idcategory": "4",
            "number": "4",
            "name": "Família e Habitação",
            "image": "uploads/category/XEypFdWvuAjBSds-Hia7QzmRhjtMjPu-.png",
            "color": "#ff0000",
            "description": "“O sonho de cada família é poder viver junta e feliz, num lar tranquilo e pacífico, em que os pais têm oportunidade de criar os filhos da melhor maneira possível, ou de orientá-los e ajudar a escolher as suas carreiras, dando-lhes o amor e carinho que desenvolverá neles um sentimento de segurança e de autoconfiança” – Nelson Mandela in “Carta a Zindzi Mandela (1970)”",
            "status": "1"
        },
        {
            "idcategory": "5",
            "number": "5",
            "name": "Saúde e Serviços Médicos",
            "image": "uploads/category/3reSv5iuR2OTK1ncknzxiyAGOlNnG5vc.png",
            "color": "#732110",
            "description": "A saúde é um bem essencial por isso preserve-o!\r\nDoar sangue é dar vida.",
            "status": "1"
        }
    ]
}
 *@apiSuccessExample Response-Empty:
 * {
    "status": 200,
    "status_message": "List Guia not Found",
    "data": "null"
 * }
 *
 * @apiUse UserNotFoundError
 */

/**
 * @api {get} http://XXX.X.X.X/casadocidadao/api/topicos/categoria/:id_categoria Request  Topicos da Categoria
 * @apiName Obter Lista de Todos os Topicos da Categoria Selecionada
 * @apiGroup Guia de Servico
 *
 * @apiParam {Number} id_categoria          ID identificador da Categoria desejada.
 *
 * @apiSuccess {Number} status Codigo do Retorno.
 * @apiSuccess {String} status_message Mensagem Confirmacao.
 * @apiSuccess {String} data Lista de Objecto (JSonArray).
 * @apiSuccess {Number} idtopic Id Unico Do Topico (Identificador).
 * @apiSuccess {Number} category_idcategory Id da Categoria relacionada ao Topico
 * @apiSuccess {Float}  number Numero representante a order de organizacao
 * @apiSuccess {String} name Nome do referido Topico.
 * @apiSuccess {String} image Image representativo ao Topico.
 * @apiSuccess {String} description Descricao representativo ao Topico.
 * @apiSuccess {Number} status Estado do Topico (0-Indesponivel, 1-Desponivel).
 *
 * @apiSuccessExample Success-Response:
 *  {
    "status": 200,
    "status_message": "List Topics Found",
    "data": [
        {
            "idtopic": "1",
            "category_idcategory": "1",
            "number": "1.1",
            "name": "Estou grávida e o nosso filho(a) vai nascer",
            "image": "uploads/topic/CaesQNHKGstUWQ8j9k-xrQfbNWliwb1C.png",
            "description": "A gravidez é uma etapa importante na vida dos pais e de toda a família. Mas, também é uma etapa que merece muitos cuidados com a mãe e o bebé para que tudo corra bem e a recuperação seja a melhor.",
            "status": "1"
        },
        {
            "idtopic": "2",
            "category_idcategory": "1",
            "number": "1.2",
            "name": "Quero registar o meu filho",
            "image": "uploads/topic/jDRnRpQEP5StYLQUkTWh6c-fZRMvXy8M.png",
            "description": "Todo o cidadão tem direito a um registo de nascimento e, através dele provar a sua identidade.",
            "status": "1"
        },
        {
            "idtopic": "3",
            "category_idcategory": "1",
            "number": "1.3",
            "name": "Quero obter uma cédula pessoal",
            "image": "uploads/topic/UakUKx8j2xva7Jsp0DQJIfziXlnJvZJT.png",
            "description": "Cédula pessoal é um comprovativo do registo de nascimento de uma criança, entregue logo após o ato do registo.",
            "status": "1"
        }
    ]
}
 *@apiSuccessExample Response-Empty:
 * {
    "status": 200,
    "status_message": "List Topics not Found",
    "data": "null"
 * }
 *
 *
 * @apiUse UserNotFoundError
 */

/**
 * @api {get} http://XXX.X.X.X/casadocidadao/api/subtopic/topico/:id_topic Request SubTopicos de um Topicos
 * @apiName Obter Lista de Todos os SUB-Topicos, descrisao, iten de um determinado do Topico
 * @apiGroup Guia de Servico
 *
 * @apiParam {Number} id_topic          ID identificador do Topico desejado.
 *
 * @apiSuccess {Number} status Codigo do Retorno.
 * @apiSuccess {String} status_message Mensagem Confirmacao.
 * @apiSuccess {String} data Lista de Objecto (JSonArray).
 * @apiSuccess {Number} idsubtopic Id Unico Do SubTopico (Identificador).
 * @apiSuccess {Number} topic_category_idcategory Id da Categoria relacionada ao Topico do SubTopico
 * @apiSuccess {Number} topic_idtopic ID do Topico relacionado ao SUbTopico
 * @apiSuccess {String} name Nome do referido SubTopico.
 * @apiSuccess {String} localizacao_idlocalizacao Localizacao do SubTopico em Coordenada (latitude;longitude).
 * @apiSuccess {Number} status Estado do SubTopico (0-Indespoinvel, 1-Desponivel).
 * @apiSuccess {Array} description Array com todos as informacao do SubTOpico.
 * @apiSuccess {Number} iddescription Id Unico pertencente a descricao (Array) do SubTopico
 * @apiSuccess {Number} subtopic_idsubtopic ID do SUbTopico
 * @apiSuccess {Array}  iten Array com todos os Iten do subtopico/ pontos do subtopico 
 * @apiSuccess {Number} iddetail Id unico do detalhe do Iten do SubTopico
 * @apiSuccess {Number} description_iddescription ID perterncete a que descricao o Item pertence
 * @apiSuccess {String} description Texto do ponto do SubIten
 *
 * @apiSuccessExample Success-Response:
 *  {
    "status": 200,
    "status_message": "List Topics Found",
    "data": [
        {
            "idsubtopic": "1",
            "topic_category_idcategory": "1",
            "topic_idtopic": "1",
            "name": "Como obter orientação médica?",
            "localizacao_idlocalizacao": null,
            "status": "1",
            "description": [
                {
                    "iddescription": "1",
                    "subtopic_idsubtopic": "1",
                    "description": "dfgdfgdfgdfgdfgdfgdfgdfgfd",
                    "status": "1",
                    "iten": [
                        {
                            "iddetail": "1",
                            "description_iddescription": "1",
                            "description": "wfeeererer",
                            "status": null
                        },
                        {
                            "iddetail": "2",
                            "description_iddescription": "1",
                            "description": "sdfdfgfdgdfgdfg",
                            "status": null
                        }
                    ]
                }
            ]
        },
        {
            "idsubtopic": "2",
            "topic_category_idcategory": "1",
            "topic_idtopic": "1",
            "name": "Como obter o subsídio de aleitamento?",
            "localizacao_idlocalizacao": null,
            "status": "1",
            "description": []
        }
    ]
}
 *@apiSuccessExample Response-Empty:
 * {
    "status": 200,
    "status_message": "List SubTopics not Found",
    "data": "null"
 * }
 *
 * @apiDescription This is the Description.
 * It is multiline capable.
 *
 * Last line of Description.
 *
 * @apiUse UserNotFoundError
 */


?>