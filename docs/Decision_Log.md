# 📜 Journal des Décisions Techniques (ADR)

Ce document trace l'historique des **décisions structurantes** prises pour le projet "BugHunter AI". Il a vocation à expliquer "Pourquoi" certains arbitrages techniques, produit ou sécurité ont été pris afin d'éviter les remises en question futures et de faciliter la soutenance du projet.

---

## 🛠️ Modèle d'une Décision (Template)
Chaque décision suit la structure de référence MADR (Markdown Architecture Decision Records) :
1. **Contexte :** Quel était le problème ?
2. **Options :** Quelles étaient les solutions ?
3. **Choix Retenu :** La décision finale.
4. **Compromis (Conséquences) :** Ce que ce choix implique (positif/négatif).

---

## 📅 Chronologie des Arbitrages

### [ADR-001] Frontend : Intégration Tailwind CSS via CDN
- **Date :** 8-9 Avril 2026
- **Catégorie :** Déploiement / Interface
- **Contexte :** Pour la Landing Page (US07), il fallait un rendu visuel attrayant extrêmement rapidement sans casser la chaine d'intégration Laravel et sans faire attendre le framework NPM/Vite.
- **Choix Retenu :** **Option CDN.**
- **Compromis accepté :** Priorité à la vitesse d'itération MVP sur l'optimisation pure du build.

### [ADR-002] Données : Les Quiz appartiennent à tous (Pas de `user_id`)
- **Date :** 9 Avril 2026
- **Catégorie :** Architecture Backend / Modélisation
- **Contexte :** Faut-il cloisonner les quiz générés pour que seul le créateur puisse y jouer ou les partager ?
- **Choix Retenu :** **Bac à sable partagé (Table pivot Quiz_User).**
- **Compromis accepté :** Facilite la découverte communautaire pour le MVP.

### [ADR-003] Sécurité : L'Étudiant est Créateur
- **Date :** 9 Avril 2026
- **Catégorie :** Sécurité / Produit
- **Contexte :** Qui a le droit de générer des quiz (coût API LLM) ?
- **Choix Retenu :** **Tout utilisateur authentifié.**
- **Compromis accepté :** Risque de spam à mitiger par Rate-Limiting futur.

### [ADR-004] Interopérabilité : Le choix de l'API REST JSON
- **Date :** 9 Avril 2026
- **Catégorie :** Architecture Route et Cloud
- **Contexte :** Communication entre le frontend (Blade/JS) et la génération IA.
- **Choix Retenu :** **Format JSON strict.**
- **Compromis accepté :** Permet une future transition vers Mobile (Flutter/React Native) sans réécrire le backend.

### [ADR-005] Produit : Pivot vers "BugHunter AI" (Hacker Theme)
- **Date :** 9 Avril 2026
- **Catégorie :** Produit / UX
- **Contexte :** Transformer le quiz générique en outil de lecture critique de code.
- **Choix Retenu :** **Gamification Cyber/Hacker.**

### [ADR-006] Performance : Migration de Gemini vers Groq (Llama 3)
- **Date :** 9 Avril 2026
- **Catégorie :** Backend / Infrastructure IA
- **Contexte :** Latences importantes avec Gemini.
- **Choix Retenu :** **Groq Cloud (Llama 3.3).**
- **Conséquences :** Génération quasi instantanée (~1s).

### [ADR-007] Pédagogie : Rapports d'Analyse Post-Mortem
- **Date :** 9 Avril 2026
- **Contexte :** Expliquer le bug après la réponse.
- **Choix Retenu :** **Champ `explanation` généré par l'IA.**

### [ADR-008] Engagement : Système de Réputation (XP) et Leaderboard
- **Date :** 9 Avril 2026
- **Contexte :** Fidéliser et créer une progression.
- **Choix Retenu :** **Global Score (Top 50).**

### [ADR-009] Gamification : Arène des Duels et Chronométrage
- **Date :** 10 Avril 2026
- **Catégorie :** Gameplay / Backend
- **Contexte :** Départager les meilleurs opérateurs.
- **Choix Retenu :** **Duels asynchrones avec tie-break Milliseconde.**
- **Conséquences :** Introduction du "Reputation Transfer" (enjeux réels).

### [ADR-010] Qualité : Pipeline CI/CD Industriel (GitHub Actions)
- **Date :** 10 Avril 2026
- **Catégorie :** DevOps
- **Contexte :** Comment empêcher un code cassé ou une régression d'atteindre la branche principale ?
- **Choix Retenu :** **Mise en place de tests automatisés (Unit/Feature) bloquants en CI.**
- **Conséquences :** Sécurise le développement collaboratif.

---

> [!IMPORTANT]
> **Directive de Développement :** À chaque nouvelle décision structurante, ce journal **doit** être mis à jour !
