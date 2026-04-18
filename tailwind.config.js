module.exports = {
    content: [
      "./resources/**/*.blade.php", // Scan all Blade files
      "./resources/**/*.js",        // Scan JS files
    ],
    theme: {
        extend: {
          colors: {
            'marsa-blue': '#002366',
            'marsa-gold': '#FFD700',
            'marsa-navy': '#001A4D',
          },
          backdropBlur: {
            xs: '2px',
            sm: '4px',
          }
        }
      },
    plugins: [],
  }