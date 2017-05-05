SELECT 
		BIZ.id AS business_id,
		BIZ.name AS business_name,
		BIZ.responsable_percent AS business_percent,
		M.idmarca AS marca_id,
		M.nome AS marca_nome,
		P.idprodutor AS produtor_id,
		P.nome as produtor_nome,
		E.idevento AS evento_id,
		E.nome AS evento_nome,
        E.data as evento_data,
        E.estado as evento_estado,
		B.descricao_bilhete as bilhete_nome,
		B.idbilhete as bilhete_id,
		B.preco as bilhete_preco,
		B.stock as bilhete_stock,
		CB.dataCompra AS data_compra,
		CB.dataCompra AS date,
		CB.business_percent as business_compra_percent,
		B.business_percent as business_bilhete_percent,

		-- some tickets aggs
		greatest(B.stock-count(1), 0)  AS tickets_current_stock,
		count(1) AS tickets_sold,

		-- global gross revenue (probably useless)
		convert(sum(B.preco),decimal(10,0)) 
			AS total_producer_gross,

		-- producer_gross_revenue
		convert(sum( B.preco - (B.preco * coalesce(CB.business_percent/100, 0) )), decimal(10,0)) 
            AS total_producer_liquid,

		-- business_gross_revenue
		convert(sum( B.preco * coalesce(CB.business_percent/100, 0) ), decimal(10,0)) 
            AS total_business_gross,

		-- business_liquid_revenue
		convert(sum( B.preco * coalesce(CB.business_percent/100, 0) ) * (responsable_percent/100), decimal(10,0)) 
            AS total_business_liquid,

		-- passafree_revenue
		convert(sum( B.preco * coalesce(CB.business_percent/100, 0) ) * ((100-responsable_percent)/100), decimal(10,0)) 
            AS total_passafree_revenue

FROM bilhete B
JOIN evento E ON E.idevento = B.evento_idevento
JOIN produtor P ON P.idprodutor = E.produtor_idprodutor
JOIN marca M ON M.idmarca = P.marca_idmarca
JOIN business BIZ ON BIZ.id = M.business_id
JOIN compra_bilhete CB ON CB.bilhete_idbilhete = B.idbilhete

GROUP BY E.idevento, B.idbilhete, CB.dataCompra
ORDER BY E.idevento ASC
