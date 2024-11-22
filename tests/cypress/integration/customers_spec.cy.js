describe('Customers', () => {
    beforeEach(() => {
        cy.login({ name: 'user' });
        cy.visit('/customers')
    })

    it('Should display a paginated list with customer information', () => {
        cy.get('.customer-row').should('have.length', 15) // Assuming each page shows 15 customers
        cy.get('.customer-row:first-child').should('contain', 'NAME')
        cy.get('.customer-row:first-child').should('contain', 'EMAIL')
        cy.get('.customer-row:first-child').should('contain', 'ORDERS')
        cy.get('.customer-row:first-child').should('contain', 'TOTAL')
    })

    it('Should allow browsing to a customer details page', () => {
        cy.get('.customer-row')
            .should('have.length.gt', 0)
            .first()
            .find('.customer-name a')
            .click() // Click the first customer's name
        cy.url().should('match', /\/customers\/\d+$/) // Assuming the URL for a customer's details page follows this pattern
        cy.get('h2').should('contain', 'Customer Detail')
    })
})

