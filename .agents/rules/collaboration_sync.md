---
trigger: when a pull is executed or when collaborating with multiple developers
---

# Synchronisation et Uniformité des Règles d'Équipe

Cette règle garantit que les consignes d'architecture, de clean code, et de Git s'appliquent de manière strictement identique à tous les collaborateurs du projet après chaque `git pull`.

1. **Unicité d'Équipe (Versionnement)** : Les fichiers de règles (situés dans `.agents/rules/`) font partie intégrante du code source. Ils ne doivent sous aucun prétexte être ajoutés au `.gitignore`. Chaque modification d'une règle (par ex: une modification dans le fichier `push.md`) doit être poussée pour qu'elle soit partagée uniformément à toute l'équipe.
2. **Mise à niveau Post-Pull** : À chaque `git pull` effectué par un collaborateur, l'agent ou le système s'assurera de recharger ces règles instantanément. Les modifications apportées par les autres membres de l'équipe devront mécaniquement être conformes aux nouvelles directives d'architecture de l'espace de travail unifié.
3. **Tolérance zéro sur la désynchronisation** : Aucun collaborateur ne doit avoir de règles "locales" silencieuses cachées. Le référentiel de `.agents/rules/` fait foi en de conflit humain ou machine.
