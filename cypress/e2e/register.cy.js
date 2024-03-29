describe('Register Frontend', () => {
    beforeEach(() => {
        cy.task('resetDB')
        cy.visit('/inscription')
    })

    it('can register', () => {
        cy.get('#user_register_email').type('cypress@gmail.com')
        cy.get('#user_register_password_first').type('123')
        cy.get('#user_register_password_second').type('123')
        cy.get("button[type='submit']").click()

        cy.url().should('include', '/connexion')

        cy.get('#inputEmail').type('cypress@gmail.com')
        cy.get('#inputPassword').type('123')
        cy.get("button[type='submit']").click()

        cy.url().should('include', '/mes-taches')
    })

    it('cannot register because email already exist', () => {
        cy.get('#user_register_email').type('hugo@gmail.com')
        cy.get('#user_register_password_first').type('123')
        cy.get('#user_register_password_second').type('123')
        cy.get("button[type='submit']").click()

        cy.url().should('include', '/inscription')
        cy.get(".invalid-feedback.d-block").should('contain', "Cette adresse email est déjà lié à un compte existant")
    })

    it('cannot register because not the same password', () => {
        cy.get('#user_register_email').type('cypress@gmail.com')
        cy.get('#user_register_password_first').type('123')
        cy.get('#user_register_password_second').type('not-the-same')
        cy.get("button[type='submit']").click()

        cy.url().should('include', '/inscription')
        cy.get(".invalid-feedback.d-block").should('contain', "Les valeurs ne correspondent pas.")
    })
})