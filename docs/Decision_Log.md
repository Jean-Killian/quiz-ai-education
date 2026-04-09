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
- **Options :**
  1. Configurer Vite avec npm install et packager les assets.
  2. Importer Tailwind via balise `<script src="cdn..."></script>`.
- **Choix Retenu :** **Option 2 (CDN).**
- **Compromis accepté :** La page charge le parseur Tailwind JS côté client (ce qui n'est pas optimal pour la web performance pure en production par rapport à un build précompilé). Ce compromis est pleinement assumé pour prioriser la *vitesse d'itération* lors du développement MVP.

### [ADR-002] Données : Les Quiz appartiennent à tous (Pas de `user_id`)
- **Date :** 9 Avril 2026
- **Catégorie :** Architecture Backend / Modélisation
- **Contexte :** Lors de la création des Entités (US13), la liberté des données s'est posée. Faut-il cloisonner les quiz générés pour que seul le créateur puisse y jouer ou les partager ?
- **Options :**
  1. Forcer la table `quizzes` avec une foreign key `owner_id`.
  2. Rendre les quiz publics et traquer uniquement les Scores `[user_id, quiz_id]` dans une table pivot.
- **Choix Retenu :** **Option 2.**
- **Compromis accepté :** Pour le MVP, la base de données est vue comme un "bac à sable partagé" pour tous les étudiants. C'est plus léger mentalement pour l'utilisateur, mais à l'avenir, si l'on veut respecter un strict principe de confidentialité pour l'étudiant, il faudra faire migrer la table pour ajouter un Auteur.

### [ADR-003] Sécurité : L'Étudiant est Créateur
- **Date :** 9 Avril 2026
- **Catégorie :** Sécurité / Produit
- **Contexte :** Qui a le droit de cliquer sur le fameux bouton "Générer avec l'IA" qui pèse potentiellement lourd sur notre consommation LLM ?
- **Options :**
  1. Restreindre via le middleware uniquement au rôle "Professeur".
  2. Démocratiser et responsabiliser l'étudiant "Utilisateur".
- **Choix Retenu :** **Option 2 (Tout étudiant authentifié).**
- **Compromis accepté :** L'avantage est l'autonomie totale (US14). L'inconvénient est le risque de spam. Il faudra anticiper à terme du Rate-Limiting (limitation de requêtes par IP) ou des crédits IA par étudiant pour ne pas exploser financièrement la facture de l'API.

### [ADR-004] Interopérabilité : Le choix de l'API REST JSON
- **Date :** 9 Avril 2026
- **Catégorie :** Architecture Route et Cloud
- **Contexte :** Comment doivent se comporter les chemins pour créer un quiz ou le soumettre (US15) alors que notre backend dispose de Blade ?
- **Options :**
  1. Envoi de formulaire classique HTTP (avec `redirect()->back()`).
  2. Couche stricte API renvoyant du format générique `JSON`.
- **Choix Retenu :** **Option 2 (API REST JSON stricte).**
- **Compromis accepté :** Demande un effort supplémentaire côté frontend (ex: Fetch JS) pour traiter la donnée asynchrone, mais garantit que l'architecture soit 100% propre, moderne, et réutilisable immédiatement si l'on veut brancher une app Mobile Flutter / React Native ou un SPA demain. C'est un gage de professionnalisme.

### [ADR-005] Produit : Pivot vers "BugHunter AI" (Hacker Theme)
- **Date :** 9 Avril 2026
- **Catégorie :** Produit / UX
- **Contexte :** Le quiz "générique" manquait de valeur ajoutée pour une école de développeurs.
- **Choix Retenu :** Gamification en mode "Hacker/Cybersecurity". Transformation des questions en blocs de code buggés.
- **Compromis :** Demande un effort de prompt engineering plus complexe pour l'IA pour garantir du code syntaxiquement correct mais logiquement faux.

### [ADR-006] Performance : Migration de Gemini vers Groq (Llama 3)
- **Date :** 9 Avril 2026
- **Catégorie :** Backend / Infrastructure IA
- **Contexte :** Latences importantes et timeouts avec l'API Gemini lors de la génération de code complexe.
- **Choix Retenu :** Passage sur l'API **Groq Cloud** avec le modèle **Llama-3.3-70b-versatile**.
- **Conséquences :** Vitesse de génération divisée par 10 (~1s vs 15s). Dépendance à une nouvelle clé d'API.

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
- **Options :**
  1. Configurer Vite avec npm install et packager les assets.
  2. Importer Tailwind via balise `<script src="cdn..."></script>`.
- **Choix Retenu :** **Option 2 (CDN).**
- **Compromis accepté :** La page charge le parseur Tailwind JS côté client (ce qui n'est pas optimal pour la web performance pure en production par rapport à un build précompilé). Ce compromis est pleinement assumé pour prioriser la *vitesse d'itération* lors du développement MVP.

### [ADR-002] Données : Les Quiz appartiennent à tous (Pas de `user_id`)
- **Date :** 9 Avril 2026
- **Catégorie :** Architecture Backend / Modélisation
- **Contexte :** Lors de la création des Entités (US13), la liberté des données s'est posée. Faut-il cloisonner les quiz générés pour que seul le créateur puisse y jouer ou les partager ?
- **Options :**
  1. Forcer la table `quizzes` avec une foreign key `owner_id`.
  2. Rendre les quiz publics et traquer uniquement les Scores `[user_id, quiz_id]` dans une table pivot.
- **Choix Retenu :** **Option 2.**
- **Compromis accepté :** Pour le MVP, la base de données est vue comme un "bac à sable partagé" pour tous les étudiants. C'est plus léger mentalement pour l'utilisateur, mais à l'avenir, si l'on veut respecter un strict principe de confidentialité pour l'étudiant, il faudra faire migrer la table pour ajouter un Auteur.

### [ADR-003] Sécurité : L'Étudiant est Créateur
- **Date :** 9 Avril 2026
- **Catégorie :** Sécurité / Produit
- **Contexte :** Qui a le droit de cliquer sur le fameux bouton "Générer avec l'IA" qui pèse potentiellement lourd sur notre consommation LLM ?
- **Options :**
  1. Restreindre via le middleware uniquement au rôle "Professeur".
  2. Démocratiser et responsabiliser l'étudiant "Utilisateur".
- **Choix Retenu :** **Option 2 (Tout étudiant authentifié).**
- **Compromis accepté :** L'avantage est l'autonomie totale (US14). L'inconvénient est le risque de spam. Il faudra anticiper à terme du Rate-Limiting (limitation de requêtes par IP) ou des crédits IA par étudiant pour ne pas exploser financièrement la facture de l'API.

### [ADR-004] Interopérabilité : Le choix de l'API REST JSON
- **Date :** 9 Avril 2026
- **Catégorie :** Architecture Route et Cloud
- **Contexte :** Comment doivent se comporter les chemins pour créer un quiz ou le soumettre (US15) alors que notre backend dispose de Blade ?
- **Options :**
  1. Envoi de formulaire classique HTTP (avec `redirect()->back()`).
  2. Couche stricte API renvoyant du format générique `JSON`.
- **Choix Retenu :** **Option 2 (API REST JSON stricte).**
- **Compromis accepté :** Demande un effort supplémentaire côté frontend (ex: Fetch JS) pour traiter la donnée asynchrone, mais garantit que l'architecture soit 100% propre, moderne, et réutilisable immédiatement si l'on veut brancher une app Mobile Flutter / React Native ou un SPA demain. C'est un gage de professionnalisme.

### [ADR-005] Produit : Pivot vers "BugHunter AI" (Hacker Theme)
- **Date :** 9 Avril 2026
- **Catégorie :** Produit / UX
- **Contexte :** Le quiz "générique" manquait de valeur ajoutée pour une école de développeurs.
- **Choix Retenu :** Gamification en mode "Hacker/Cybersecurity". Transformation des questions en blocs de code buggés.
- **Compromis :** Demande un effort de prompt engineering plus complexe pour l'IA pour garantir du code syntaxiquement correct mais logiquement faux.

### [ADR-006] Performance : Migration de Gemini vers Groq (Llama 3)
- **Date :** 9 Avril 2026
- **Catégorie :** Backend / Infrastructure IA
- **Contexte :** Latences importantes et timeouts avec l'API Gemini lors de la génération de code complexe.
- **Choix Retenu :** Passage sur l'API **Groq Cloud** avec le modèle **Llama-3.3-70b-versatile**.
- **Conséquences :** Vitesse de génération divisée par 10 (~1s vs 15s). Dépendance à une nouvelle clé d'API.

### [ADR-007] Pédagogie : Rapports d'Analyse Post-Mortem
- **Date :** 9 Avril 2026
- **Contexte :** Identifier un bug est bien, comprendre *pourquoi* c'est un bug est mieux pour l'apprentissage.
- **Choix Retenu :** Intégration d'un champ `explanation` généré par l'IA pour chaque question.
- **Conséquences :** Amélioration de la valeur éducative. Légère augmentation du coût de génération IA (plus de tokens).

### [ADR-008] Engagement : Système de Réputation (XP) et Leaderboard
- **Date :** 9 Avril 2026
- **Contexte :** Nécessité de fidéliser l'utilisateur et de créer un sentiment de progression.
- **Choix Retenu :** Mise en place d'un score global persistant et d'un classement "Elite".
- **Conséquences :** Ajout de colonnes en base de données et d'une logique de calcul de points par difficulté. Charge serveur accrue pour le calcul des classements (limité au Top 50 pour performance).

### [ADR-009] Gamification : Arène des Duels et Chronométrage Milliseconde
- **Date :** 10 Avril 2026
- **Catégorie :** Gameplay / Backend
- **Contexte :** Comment départager deux excellents opérateurs qui réussissent sans faute les mêmes missions ?
- **Options :**
  1. Multijoueur synchrone via WebSockets (trop lourd pour le MVP).
  2. Duels asynchrones avec tie-break basé sur la rapidité (ms).
- **Choix Retenu :** **Option 2.**
- **Conséquences :** Offre une dimension compétitive forte ("Hacker Speedrun"). Demande une précision de mesure absolue via `performance.now()` en JS et un stockage `unsignedBigInteger` en base. Introduction d'une notion de "Reputation Transfer" (le gagnant capture de l'XP du perdant) pour augmenter les enjeux.

---

> [!IMPORTANT]
> **Directive de Développement :** À chaque nouvelle crise d'architecture future (ex: Ajout d'une base NoSQL, Refonte des rôles, Stratégie de mise en cache LLM), ce journal **doit** être mis à jour !
