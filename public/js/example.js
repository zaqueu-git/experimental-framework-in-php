document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.action-button').forEach(element => {
        element.addEventListener('click', () => {
            switch (element.getAttribute('data')) {
                case 'home':
                    window.open('/', '_self');
                    break;
                case 'crud':
                    window.open('crud', '_self');
                    break;
                case 'api':
                    window.open('api', '_self');
                    break;
            }
        })
    });
});