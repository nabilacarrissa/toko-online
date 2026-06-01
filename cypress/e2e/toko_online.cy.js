describe('E2E Toko Online System Test', () => {
  it('Berhasil menampilkan produk dan keranjang di halaman utama', () => {
    // Kunjungi halaman login dan lakukan login dulu (akun admin uji)
    cy.visit('http://localhost:8000/login.php');
    cy.get('input[name="email"]').type('admin@local');
    cy.get('input[name="password"]').type('admin123');
    cy.get('button').contains('Masuk').click();

    // Setelah login, harus diarahkan ke admin panel
    cy.url().should('include', 'admin.php');
    cy.contains('Panel Admin').should('be.visible');

    // Pastikan daftar produk muncul dan salah satunya terlihat
    cy.contains('Kemeja Flanel').should('be.visible');
  })
})