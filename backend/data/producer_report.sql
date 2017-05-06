SELECT 
	M.nome as marca_nome,
    M.idmarca as marca_id,
	BZ.id as business_id,
    BZ.name as business_name,
    BZ.responsable_percent,
    P.idprodutor as producer_id,
    P.nome as producer_nome,
    P.foto as producer_picture

FROM evento E 
JOIN produtor P ON P.idprodutor = E.produtor_idprodutor
JOIN marca M ON M.idmarca = P.marca_idmarca
JOIN business BZ on BZ.id = M.business_id

