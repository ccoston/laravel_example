describe('Orders', () => {
    beforeEach(() => {
        cy.login({ name: 'user' });
        cy.visit('/orders')
    })

    it('Should display a paginated list with order information', () => {
        cy.get('.order-row')
            .should('have.length', 15) // Assuming each page shows 15 orders
        cy.get('.order-row:first-child')
            .should('contain', 'ORDER #')
        cy.get('.order-row:first-child')
            .should('contain', 'STATUS')
        cy.get('.order-row:first-child')
            .should('contain', 'CUSTOMER')
        cy.get('.order-row:first-child')
            .should('contain', 'ORDER PLACED')
        cy.get('.order-row:first-child')
            .should('contain', 'ITEMS')
        cy.get('.order-row:first-child')
            .should('contain', 'TOTAL')
    })

    it('Should allow browsing to a order details page', () => {
        cy.get('.order-row')
            .first()
            .first()
            .find('a')
            .click() // Click the first order's name
        cy.url().should('match', /\/orders\/\d+$/) // Assuming the URL for a order's details page follows this pattern
        cy.get('h2').should('contain', 'Order Detail')
    })
})
