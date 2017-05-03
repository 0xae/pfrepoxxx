SELECT 
	E.idevento,
	E.nome as evento_nome,
	B.nome_bilhete,
    B.preco,
    CB.dataCompra as data_compra,
    count(1) as total_comprado,
    sum(B.preco) as total_venda

FROM passafree.bilhete B
JOIN passafree.evento E ON E.idevento = B.evento_idevento
JOIN passafree.compra_bilhete CB ON CB.bilhete_idbilhete = B.idbilhete
JOIN passafree_backoffice.business_producer BP on BP.producer_id = E.produtor_idprodutor
JOIN passafree_backoffice.business BZ on BZ.id = BP.business_id

WHERE CB.dataCompra BETWEEN :start AND :end
AND BZ.id = :business

GROUP BY E.idevento, B.nome_bilhete, CB.dataCompra
ORDER BY CB.dataCompra desc