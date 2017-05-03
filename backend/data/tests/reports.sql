SELECT 
    M.nome as nome_marca,
	P.nome as nome_produtor,
	E.nome as titulo_evento,
    E.data as data_evento,
	B.nome_bilhete,
	B.descricao_bilhete,
    B.preco,
    B.stock,
    B.comprado,
    B.estado as bilhete_estado
FROM bilhete B
JOIN evento E ON E.idevento = B.evento_idevento
JOIN compra_bilhete CB ON