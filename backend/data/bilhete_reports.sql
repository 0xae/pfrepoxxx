SELECT 
	BIZ.id AS business_id,
    BIZ.name as business_name,
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
    (B.stock-count(1)) AS restante,
    count(1) AS total_comprado,
    sum(B.preco) AS total_venda

FROM passafree_ultimate.bilhete B
JOIN passafree_ultimate.evento E ON E.idevento = B.evento_idevento
JOIN passafree_ultimate.produtor P ON P.idprodutor = E.produtor_idprodutor
JOIN passafree_ultimate.marca M ON M.idmarca = P.marca_idmarca
JOIN passafree_ultimate.business BIZ ON BIZ.id = M.business_id
JOIN passafree_ultimate.compra_bilhete CB ON CB.bilhete_idbilhete = B.idbilhete

GROUP BY E.idevento, B.idbilhete, CB.dataCompra
ORDER BY E.idevento ASC
