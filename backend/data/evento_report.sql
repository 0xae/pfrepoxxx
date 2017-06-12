SELECT 
	BZ.id AS business_id,
    BZ.name AS business_name,
    BZ.responsable_percent AS business_percent,

    P.idprodutor AS producer_id,
    P.nome AS producer_name,
    P.foto AS producer_picture,
    
    M.idmarca as marca_id,
    M.nome as marca_nome,
    M.logo as marca_picture,

    E.idevento as evento_id,
	E.nome AS evento_nome,
    E.data AS evento_data,
    E.estado as evento_estado,

    (select count(1) from gosto 
        where evento_idevento = E.idevento
    ) AS evento_likes,

    (select count(1) from comentario 
        where evento_idevento = E.idevento
    ) AS evento_comments

FROM evento E 
JOIN produtor P ON P.idprodutor = E.produtor_idprodutor
JOIN marca M ON M.idmarca = P.marca_idmarca
JOIN business BZ on BZ.id = M.business_id
