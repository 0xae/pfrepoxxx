SELECT 
	BZ.id AS business_id,
    BZ.name AS business_name,
    BZ.responsable_percent AS business_percent,

    P.idprodutor AS producer_id,
    P.nome AS producer_name,
    P.foto AS producer_picture,

    E.idevento as evento_id,
	E.nome AS evento_nome,
    E.data AS evento_data

FROM evento E 
JOIN produtor P ON P.idprodutor = E.produtor_idprodutor
JOIN marca M ON M.idmarca = P.marca_idmarca
JOIN business BZ on BZ.id = M.business_id
