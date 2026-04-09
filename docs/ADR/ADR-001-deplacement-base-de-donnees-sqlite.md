# Déplacement de la base de données SQLite

1. **Titre et Statut** : Déplacement de la base de données (Accepté).
2. **Date** : 2026-04-09
3. **Auteur** : Antigravity (validé par l'utilisateur).
4. **Contexte** : Un fichier SQLite `quiz_ai` se trouvait de manière orpheline à la racine du projet, ce qui nuit à l'architecture du projet Laravel et enfreint la règle "Aucun Fichier Orphelin".
5. **Options envisagées** : 
   - A. Laisser en racine (Contre: pas standard, salit le répertoire).
   - B. Déplacer dans `database/quiz_ai.sqlite` (Pour: architecture Laravel standard, rangement pérenne).
6. **Choix retenu et Justification** : Option B choisie pour suivre les conventions MVC et le rangement par défaut du framework Laravel.
7. **Compromis & Conséquences** : Acceptation du risque mineur de devoir ajuster le fichier `.env` si l'ancienne localisation (racine) y était référencée en dur.
8. **Impacts et Dépendances** : Modification du comportement d'accès SQLite, nécessitant sa localisation exacte dans le dossier de BDD.
