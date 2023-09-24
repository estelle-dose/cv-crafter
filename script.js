        // JavaScript pour afficher/masquer les formulaires associés aux liens
        const experienceLink = document.getElementById('experience-link');
        const experienceForm = document.getElementById('experience-form');

        experienceLink.addEventListener('click', () => {
            if (experienceForm.style.display === 'none' || experienceForm.style.display === '') {
                experienceForm.style.display = 'block';
            } else {
                experienceForm.style.display = 'none';
            }
        });

        const formationLink = document.getElementById('formation-link');
        const formationForm = document.getElementById('formation-form');

        formationLink.addEventListener('click', () => {
            if (formationForm.style.display === 'none' || formationForm.style.display === '') {
                formationForm.style.display = 'block';
            } else {
                formationForm.style.display = 'none';
            }
        });

        const competenceLink = document.getElementById('competence-link');
        const competenceForm = document.getElementById('competence-form');

        competenceLink.addEventListener('click', () => {
            if (competenceForm.style.display === 'none' || competenceForm.style.display === '') {
                competenceForm.style.display = 'block';
            } else {
                competenceForm.style.display = 'none';
            }
        });

        const interetLink = document.getElementById('interet-link');
        const interetForm = document.getElementById('interet-form');

        interetLink.addEventListener('click', () => {
            if (interetForm.style.display === 'none' || interetForm.style.display === '') {
                interetForm.style.display = 'block';
            } else {
                interetForm.style.display = 'none';
            }
        });

        const langueLink = document.getElementById('langue-link');
        const langueForm = document.getElementById('langue-form');

        langueLink.addEventListener('click', () => {
            if (langueForm.style.display === 'none' || langueForm.style.display === '') {
                langueForm.style.display = 'block';
            } else {
                langueForm.style.display = 'none';
            }
        });