// import defaultTheme from "tailwindcss/defaultTheme";
// import forms from "@tailwindcss/forms";


// /** @type {import('tailwindcss').Config} */
// export default {
//   content: [
//     "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
//     "./storage/framework/views/*.php",
//     "./resources/views/**/*.blade.php",
//   ],

//   theme: {
//     extend: {
//       fontFamily: {
//         sans: ["Figtree", ...defaultTheme.fontFamily.sans],
//       },
//       colors: {
//         emerald: "#2ecc71",
//       },
//       colors: {
//         alizarin: "#e74c3c",
//       },
//       container: { 
//         screens: {
//           sm: '100%', // 100% de ancho en pantallas pequeñas
//           md: '100%', // 100% de ancho en pantallas medianas
//           lg: '100%', // 100% de ancho en pantallas grandes
//           xl: '100%',
//     },
//   },

//   plugins: [forms],
// };
import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ["Figtree", ...defaultTheme.fontFamily.sans],
      },
      colors: {
        emerald: "#2ecc71",
        alizarin: "#e74c3c", // Asegúrate de combinar ambos colores en un solo objeto
      },
      container: {
        center: true, // Esto centra el contenedor en la pantalla
        padding: '2rem', // Agrega un padding general al contenedor
        screens: {
          sm: '100%',  // 100% de ancho en pantallas pequeñas
          md: '100%',  // 100% de ancho en pantallas medianas
          lg: '100%',  // 100% de ancho en pantallas grandes
          xl: '100%',  // 100% de ancho en pantallas extra grandes
        },
      },
    },
  },

  plugins: [forms],
};