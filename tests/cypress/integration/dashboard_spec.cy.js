describe('Dashboard', () => {
    beforeEach(() => {
        cy.login({ name: 'user' });
        cy.visit('/')
    })

    it('displays orders container with "Orders in Past Seven Days" and "view all orders" link', () => {
        cy.get('#OrdersContainer')
            .should('contain', 'Orders in Past Seven Days')
            .find('.view-all-link')
            .contains('View all orders')
            .should('have.attr', 'href')
            .and('contain', '/orders')

        cy.get('#OrdersContainer')
            .find('.view-all-link')
            .should('be.visible')
            .click()

        cy.url().should('include', '/orders')
    })

    it('displays products container with "Top 3 Products In Last Seven Days"', () => {
        cy.get('#ProductsContainer')
            .should('contain', 'Top 3 Products In Last Seven Days')
            .find('article')
            .should('have.length', 3)
            .each(($product) => {
                cy.wrap($product).find('a').should('have.attr', 'href').and('contain', '/products/')
            })

        cy.get('#ProductsContainer')
            .find('.view-all-link')
            .should('be.visible')
            .click()

        cy.url().should('include', '/products')
    })

    it('displays customers container with "Top Three Customers In Last Seven Days"', () => {
        cy.get('#CustomersContainer')
            .should('contain', 'Top Three Customers In Last Seven Days')
            .find('article')
            .should('have.length', 3)
            .each(($customer) => {
                cy.wrap($customer).find('a').should('have.attr', 'href').and('contain', '/customers/')
                cy.wrap($customer).find('.total').should('contain', '$')
            })

        cy.get('#ProductsContainer')
            .find('.view-all-link')
            .should('be.visible')
            .click()

        cy.url().should('include', '/products')
    })
})
