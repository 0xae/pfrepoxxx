SELECT 
	M.nome as marca_nome,
	BZ.id as business_id,
    BZ.name as business_name,
    BZ.responsable_percent,
    P.idprodutor as producer_id,
    P.nome as producer_nome,
    P.foto as producer_picture,
    count(1) as total_comprado,
    sum(B.preco) as total_venda

FROM passafree.bilhete B
JOIN passafree.evento E ON E.idevento = B.evento_idevento
JOIN passafree.produtor P ON P.idprodutor = E.produtor_idprodutor
JOIN passafree.marca M ON M.idmarca = P.marca_idmarca
JOIN passafree.compra_bilhete CB ON CB.bilhete_idbilhete = B.idbilhete
JOIN passafree.business_producer BP on BP.producer_id = E.produtor_idprodutor
JOIN passafree.business BZ on BZ.id = BP.business_id

where CB.dataCompra between :start and :end
group by P.idprodutor
order by CB.dataCompra desc