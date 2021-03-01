--Requête SQL pour afficher tous les emprunts de l'abonné dont le pseudo est égal "admin"

-- REQUÊTE AVEC JOIN
SELECT e.*
FROM emprunt e JOIN abonne a ON e.abonne_id = a.id
WHERE a.pseudo = "admin"

-- REQUÊTE identique sans utiliser JOIN
SELECT e.*
FROM emprunt e, abonne a
WHERE e.abonne_id = a.id AND a.pseudo = "admin"


-- Requête SQL pour afficher tous les emprunts du 
-- livre nommé "Dune" (en utilisant JOIN)
SELECT e.*
FROM emprunt e JOIN livre l ON e.livre_id = l.id
WHERE l.titre = "Dune"

-- Le titre des livres empruntés par l'abonné "admin"
SELECT DISTINCT l.titre
FROM abonne a 
    JOIN emprunt e ON a.id = e.abonne_id
    JOIN livre l ON e.livre_id = l.id
WHERE a.pseudo = "admin"