SELECT 
	BZ.id AS business_id,
    BZ.name AS business_name,
    BZ.responsable_percent,

    P.idprodutor AS producer_id,
    P.nome AS producer_nome,
    P.foto AS producer_picture,

	E.nome AS titulo_evento,
    E.data AS data_evento,
    E.idevento as evento_id

FROM evento E 
JOIN produtor P ON P.idprodutor = E.produtor_idprodutor
JOIN marca M ON M.idmarca = P.marca_idmarca
JOIN business BZ on BZ.id = M.business_id
