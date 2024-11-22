describe('Products', () => {
    beforeEach(() => {
        cy.login({ name: 'user' });
        cy.visit('/products')
    })

    it('Should display a paginated list with product information', () => {
        cy.get('.product-item')
            .should('have.length', 15) // Assuming each page shows 15 products
        cy.get('.product-item:first-child .product-image')
            .should('have.attr', 'href')
        cy.get('.product-item:first-child .product-name')
            .should('have.attr', 'href')
        cy.get('.product-item:first-child .product-name h3')
            .invoke('text') // get the text content of the container
            .then(text => {
                expect(typeof text).to.equal('string'); // assert that the type of the text content is a string
            });
        cy.get('.product-item:first-child .product-price')
            .invoke('text') // get the text content of the container
            .then(text => {
                expect(text).to.match(/^\$\d+(,\d{3})*(\.\d{2})?$/); // assert that the text content matches US dollar format
            });
    })

    it('Should allow browsing to a product details page', () => {
        cy.get('.product-item:first-child .product-name')
            .click() // Click the first product's name
        cy.url().should('match', /\/products\/\d+$/) // Assuming the URL for a product's details page follows this pattern
        cy.get('h2').should('contain', 'Product Detail')
    })
})
