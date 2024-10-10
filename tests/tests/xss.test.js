const { JSDOM } = require('jsdom');

// Fonction pour échapper le HTML
function escapeHTML(input) {
    return input.replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
}

describe('XSS Protection Test', () => {
    test('should escape malicious input', () => {
        // Simuler une entrée malveillante
        const maliciousInput = '<script>alert("XSS")</script>';

        // Echapper l'entrée malveillante
        const escapedInput = escapeHTML(maliciousInput);

        // Créer un environnement DOM avec l'entrée échappée
        const dom = new JSDOM(`<!DOCTYPE html><p id="content">${escapedInput}</p>`);
        const content = dom.window.document.getElementById('content').innerHTML;

        // Vérifier si l'entrée est échappée
        expect(content).not.toBe(maliciousInput);
        expect(content).toBe('&lt;script&gt;alert("XSS")&lt;/script&gt;');
    });
});