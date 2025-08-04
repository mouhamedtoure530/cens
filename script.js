document.addEventListener('DOMContentLoaded', () => {
    // Gestion du menu de navigation mobile
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    navToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        navToggle.querySelector('i').classList.toggle('fa-bars');
        navToggle.querySelector('i').classList.toggle('fa-times');
    });

    // Fermer le menu lors du clic sur un lien (sur mobile)
    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
            navToggle.querySelector('i').classList.remove('fa-times');
            navToggle.querySelector('i').classList.add('fa-bars');
        });
    });

    // Animation de révélation des sections au défilement
    const sectionsToReveal = document.querySelectorAll('.reveal');
    const options = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, options);

    sectionsToReveal.forEach(section => {
        observer.observe(section);
    });
});
document.addEventListener('DOMContentLoaded', () => {
    // Sélectionne tous les éléments de la FAQ
    const faqItems = document.querySelectorAll('.faq-item');

    // Pour chaque élément de la FAQ...
    faqItems.forEach(item => {
        // ...on sélectionne l'en-tête (la question)
        const question = item.querySelector('h3');

        // On écoute le clic sur la question
        question.addEventListener('click', () => {
            // On bascule la classe 'active' pour afficher/masquer la réponse
            item.classList.toggle('active');
        });
    });
});

