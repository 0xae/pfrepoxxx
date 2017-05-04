SELECT 
	BIZ.id AS business_id,
	BIZ.name as business_name,
    BIZ.responsable_percent,
	M.idmarca as marca_id,
	M.nome as marca_nome,
	P.idprodutor as produtor_id,
	P.nome as produtor_nome,
	E.idevento as evento_id,
	E.nome AS evento_nome,
	B.nome_bilhete,
	B.idbilhete,
	B.preco,
	B.stock,
	CB.dataCompra AS data_compra,
	CB.business_percent as compra_business_percent,
	B.business_percent as bilhete_business_percent,
	(B.stock-count(1)) AS restante,
	count(1) AS total_comprado,
	sum(B.preco) AS total_venda,
	cast(sum(B.preco - (B.preco * (coalesce(CB.business_percent/100, 1)))) as decimal(10,0)) AS total_venda_produtor,
	cast(sum(B.preco * (coalesce(CB.business_percent/100, 1))) as decimal(10,0)) AS total_venda_business

FROM bilhete B
JOIN evento E ON E.idevento = B.evento_idevento
JOIN produtor P ON P.idprodutor = E.produtor_idprodutor
JOIN marca M ON M.idmarca = P.marca_idmarca
JOIN business BIZ ON BIZ.id = M.business_id
JOIN compra_bilhete CB ON CB.bilhete_idbilhete = B.idbilhete

GROUP BY E.idevento, B.idbilhete, CB.dataCompra
ORDER BY E.idevento ASC
