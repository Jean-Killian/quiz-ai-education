# 🔐 Architecture : Rôles, Permissions et Gestion des Erreurs

Ce document décrit la matrice de sécurité applicative (US14) et les comportements standards attendus par le MVP pour harmoniser l'expérience de l'utilisateur face aux échecs logiciels.

---

## 1. Matrice des Rôles et Permissions

Suite aux décisions d'architecture MVP de l'application, l'accès à la génération de Quiz est fondamentalement démocratisé pour garantir à l'étudiant son autonomie.

| Rôle | Périmètre & Actions Autorisées | Actions Refusées / Interdites |
|------|---------------------------------|-------------------------------|
| **Visiteur (Guest)** | Consulter la Landing Page (Accueil).<br>Créer un compte et s'authentifier. | Accéder aux tableaux de bord internes.<br>Consulter l'URL de création de quiz (`/quizzes/generate`). |
| **Utilisateur (Étudiant)** | Générer un quiz à l'aide de l'IA.<br>Parcourir la liste des quiz existants.<br>Passer un test et incrémenter son score. | Accéder au panel d'administration global.<br>Bannir des utilisateurs. |
| **Administrateur** | Visualiser l'ensemble des données du système.<br>Contrôler les logs et intervenir sur les erreurs. | N/A |

*(Note technique : Les restes de middlewares ciblant des rôles comme `Teacher` ou `Schools` sont considérés hors du scope de ce MVP axé étudiant).*

---

## 2. Typologie des Erreurs et Stratégie UI

Pour éviter tout comportement "patchwork" ou cryptique pour nos étudiants, l'application est structurée autour de 3 familles d'erreurs clairement identifiées.

### A. Erreurs de Validation (Code 422)
Déclenchées lorsqu'une donnée saisie ne respecte pas le format attendu.
- **Principe :** Ne jamais réinitialiser ou vider le formulaire de l'utilisateur.
- **Comportement Interface :** Le champ fautif passe en bords rouges (`ring-red-500 border-red-500`) et le message de feedback explicite s'affiche directement en dessous (ex: "*Le texte de votre cours est trop court pour générer un test sérieux*").

### B. Erreurs Métier & Accès Refusé (Codes 401 / 403)
Déclenchées lorsqu'un acte métier est prohibé ou qu'une ressource n'appartient pas à la personne.
- **Exemple de Refus (Access Denied) :** Un `Visiteur` qui n'a pas voulu s'inscrire tape directement `http://localhost:8000/quizzes/generate` dans son navigateur.
- **Comportement Interface :** Interception par le middleware standard. Redirection automatique vers la Landing Page ou vers `/login` avec un message Toast visuel ("*Veuillez vous asurer d'être connecté pour créer vos révisions*"). Ne jamais afficher l'écran blanc mortel système.

### C. Erreurs Techniques et Critiques (Code 500+)
Déclenchées lorsque le logiciel s'effondre (Base de données saturée, timeout, etc...).
- **Exemple de Cas Critique (Panne Générateur IA) :** L'étudiant colle 3 pages de cours de Droit, appuie sur "Générer", mais l'API de Modèle d'IA externe recrache du vide ou subit une indisponibilité temporaire (`Timeout`).
- **Comportement API & Backend :** Attraper l'Exception (`catch`), tracer l'erreur silencieusement et de manière intelligible dans `storage/logs/laravel.log`.
- **Comportement Interface :** Masquer les codes d'erreur bruts. Retourner une vue "Amicale" d'excuse ("*Oups ! Notre Professeur Numérique (IA) semble momentanément indisponible. Le trafic est sûrement important, réessayez dans quelques secondes !*").

---

## 3. Stratégie de Feedback Visuel (Guides Standard)

L'UX intègre trois statuts de notifications éphémères ('Flash Messages' ou 'Toasts') qu'il faut unifier dans les composants Blade (`layouts/app.blade.php`) :

1. 🟢 **Success (Vert) :** Remonter la confirmation d'une action réussie ("Quiz généré avec succès !", "Score enregistré : 8/10 !").
2. 🟠 **Warning (Orange) :** Retour d'un conflit léger ("Vous avez déjà passé ce test, score remplacé").
3. 🔴 **Danger (Rouge) :** Avertissement sur une interruption de flux critique ("L'IA n'a pas pu traiter votre demande complexe").

*(Ces principes couvrent autant les routes API si elles renvoient du JSON, que les contrôleurs monolithiques standards via les Flash Sessions).*
