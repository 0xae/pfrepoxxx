	SELECT 
		M.idmarca as marca_id,
		M.nome as marca_nome,
		M.logo as marca_picture,
		M.estado as marca_estado,

		BZ.id as business_id,
		BZ.name as business_name,
		BZ.responsable_percent as business_percent,

		P.idprodutor as producer_id,
		P.nome as producer_nome,
		P.foto as producer_picture

	FROM produtor P
	JOIN marca M ON M.idmarca = P.marca_idmarca
	JOIN business BZ on BZ.id = M.business_id
