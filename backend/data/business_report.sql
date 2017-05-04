SELECT
	BZ.id as business_id,
    BZ.name as business_name,
    BZ.responsable_percent,
    count(1) as total_comprado,
    sum(B.preco) as total_venda,
    coalesce(((100-BZ.responsable_percent)/100) * sum(B.preco),0) as passafree_total,
    coalesce((BZ.responsable_percent/100) * sum(B.preco),0) as business_total

FROM bilhete B
JOIN evento E ON E.idevento = B.evento_idevento
JOIN compra_bilhete CB ON CB.bilhete_idbilhete = B.idbilhete
JOIN business_producer BP on BP.producer_id = E.produtor_idprodutor
JOIN business BZ on BZ.id = BP.business_id

where CB.dataCompra between  :start and :end
group by BZ.id
order by CB.dataCompra desc

-- 70,800
-- 10,500
-- 60,300
