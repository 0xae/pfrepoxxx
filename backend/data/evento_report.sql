SELECT 
	BZ.id AS business_id,
    BZ.name AS business_name,
    BZ.responsable_percent,
    P.idprodutor AS producer_id,
    P.nome AS producer_nome,
    P.foto AS producer_picture,
	E.nome AS titulo_evento,
    E.data AS data_evento,
    E.idevento as evento_id,
	B.nome_bilhete,
	B.descricao_bilhete,
    B.preco,
    B.stock,
    B.comprado,
    B.estado AS bilhete_estado,
    E.data,
    count(1) as total_comprado,
    sum(B.preco) as total_venda

FROM passafree_ultimate.bilhete B
JOIN passafree_ultimate.evento E ON E.idevento = B.evento_idevento
JOIN passafree_ultimate.produtor P ON P.idprodutor = E.produtor_idprodutor
JOIN passafree_ultimate.compra_bilhete CB ON CB.bilhete_idbilhete = B.idbilhete
JOIN passafree_ultimate.business BZ on BZ.id = BP.business_id

GROUP BY E.idevento
ORDER BY CB.dataCompra,18 DESC