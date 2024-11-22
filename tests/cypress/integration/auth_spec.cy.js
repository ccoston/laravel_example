describe('Authentication', () => {
    it('provides feedback for invalid login credentials', () => {
        // Visit the login page
        cy.visit('/login')

        // Fill in the email and password fields and submit the form
        cy.get('input[id="email"]').type('user@example.com')
        cy.get('input[id="password"]').type('wrongpassword')
        cy.get('button[type="submit"]').click()

        // Ensure that the page notifies the user that their credentials are invalid
        cy.contains('These credentials do not match our records')
    })


    it('Logs in a user', () => {
        // Visit the login page
        cy.visit('/login')

        // Fill in the email and password fields and submit the form
        cy.get('input[id="email"]').type('user@example.com')
        cy.get('input[id="password"]').type('password')
        cy.get('button[type="submit"]').click()

        // Ensure that the user is redirected to the dashboard
        cy.url().should('eq', 'http://mindsize.test/')

        // Ensure that the dashboard contains the user's name
        cy.contains('Dashboard')
        cy.contains('User')
    })
})
