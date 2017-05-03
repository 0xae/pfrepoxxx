SELECT 
    M.nome as marca_nome,
    M.logo as marca_logo,
    M.idmarca as marca_id,
	P.nome as produtor_nome,
	P.public_email as produtor_email,
    M.idprodutor as produtor_id,
	P.foto as produtor_logo,
    concat(M.nome , ' - ', P.nome) as descricao

FROM passafree.produtor P
JOIN passafree.marca M ON M.idmarca = P.marca_idmarca
LEFT JOIN passafree_backoffice.business_producer BP on BP.producer_id = P.idprodutor

WHERE BP.producer_id is null
