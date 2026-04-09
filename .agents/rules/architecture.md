---
trigger: always_on
---

# Règles Stratégiques d'Architecture et de Clean Code

Tu dois impérativement respecter les règles suivantes à chaque intervention (génération de code, refactoring, analyse) sur ce projet :

1. **Architecture Propre et Cadrée (Standards du Framework)** : 
   - Respecte l'architecture du projet et les conventions du framework (Laravel).
   - Place la logique là où elle a été pensée pour aller (sépare bien l'interface, la logique métier dans des Services ou Actions, et les requêtes en base de données).

2. **Tolérance Zéro pour les Fichiers Orphelins** : 
   - Ne crée jamais de fichiers "volants" à la racine ou dans des répertoires inappropriés. 
   - Ne laisse aucun script de test (ex: `script_test.php`, un vieux `.env.backup`) à l'abandon. Tout doit avoir un emplacement dédié ou être supprimé.

3. **Rangement Immédiat et Actif** : 
   - Range chaque fichier dès sa création (les tests formels dans `tests/`, les configurations dans `config/`). 
   - Les fichiers annexes générés par erreur ou temporairement (logs, dumps BDD, exports CSV) doivent aller dans leurs dossiers dédiés (souvent `storage/...`).

4. **Clean Code Strict** : 
   - Écris un code lisible, modulaire, structuré, en évitant les fonctions excessivement longues. 
   - Retire systématiquement tout code mort (commentarié) et TOUTES les instructions de débogage manuelles (`dump()`, `dd()`, `console.log()`) immédiatement après vérification. Ne les laisse jamais s'accumuler.

5. **Traçabilité des Décisions (ADR)** : 
   - Référent aux autres règles : à chaque fois que tu prends une décision structurelle sur le code, cela doit faire l'objet d'un "ADR" (voir la règle *journal_decisions.md*).