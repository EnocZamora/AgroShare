<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroShare - Conectando el campo con el futuro</title>
    <!-- Tailwind CSS CDN (o tu build local de Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts: Poppins & Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'verde-bosque': '#146834',
                        'verde-hoja': '#6EAF3B',
                        'beige-tierra': '#F3E9D2',
                        'marron-tierra': '#7A5A3A',
                        'gris-carbon': '#333333',
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                        heading: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-gris-carbon font-sans flex flex-col min-h-screen">

    <!-- Navegación -->
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <!-- Logo Identidad -->
                <div class="bg-verde-bosque text-white p-2.5 rounded-lg font-heading font-bold text-2xl tracking-wider">
                    A
                </div>
                <div>
                    <span class="font-heading text-2xl font-bold text-verde-bosque block leading-none">AGROSHARE</span>
                    <span class="text-[10px] text-verde-hoja tracking-widest font-semibold uppercase">Conecta • Comparte • Crece</span>
                </div>
            </div>

            <!-- Links & Acciones -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="#inicio" class="hover:text-verde-bosque transition font-medium">Inicio</a>
                <a href="#cosechas" class="hover:text-verde-bosque transition font-medium">Cosechas</a>
                <a href="#nosotros" class="hover:text-verde-bosque transition font-medium">Nosotros</a>
                <!-- Adaptación de Idioma/Inclusión -->
                <button class="text-sm bg-beige-tierra text-marron-tierra px-3 py-1.5 rounded-md font-semibold">🌐 Idioma</button>
                <a href="/login" class="bg-verde-bosque hover:bg-opacity-90 text-white px-5 py-2.5 rounded-lg font-semibold transition shadow-sm">Ingresar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="inicio" class="bg-gradient-to-br from-beige-tierra/40 via-white to-green-50 py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block bg-verde-hoja/10 text-verde-bosque text-sm font-semibold px-3 py-1 rounded-full mb-4">
                    Plataforma Agrícola de Nicaragua 🇳🇮
                </span>
                <h1 class="font-heading text-4xl md:text-5xl font-bold text-verde-bosque leading-tight mb-4">
                    Conectando el campo con el futuro
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Conectamos directamente a productores y compradores. Precios justos, compra transparente y acceso sin intermediarios para todo el país.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="#cosechas" class="bg-verde-bosque hover:bg-opacity-90 text-white font-semibold px-6 py-3.5 rounded-lg text-center shadow-md transition">Explorar Cosechas</a>
                    <a href="/registro" class="bg-verde-hoja hover:bg-opacity-90 text-white font-semibold px-6 py-3.5 rounded-lg text-center shadow-md transition">Publicar mi Producto</a>
                </div>
            </div>
            <!-- Simulación de catálogo/Search Bar -->
            <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
                <h3 class="font-heading font-semibold text-xl text-verde-bosque mb-4">Buscar Cosecha Disponibles</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                        <select class="w-full border-gray-200 rounded-lg p-2.5 bg-slate-50 border focus:ring-2 focus:ring-verde-hoja outline-none">
                            <option>Granos Básicos (Frijoles, Maíz)</option>
                            <option>Hortalizas & Verduras</option>
                            <option>Frutas de Temporada</option>
                            <option>Café & Cacao</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ubicación (Departamento)</label>
                        <select class="w-full border-gray-200 rounded-lg p-2.5 bg-slate-50 border focus:ring-2 focus:ring-verde-hoja outline-none">
                            <option>Todas las regiones</option>
                            <option>Matagalpa</option>
                            <option>Jinotega</option>
                            <option>Chinandega</option>
                            <option>Estelí</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-verde-hoja hover:bg-verde-bosque text-white font-semibold py-3 rounded-lg transition">
                        🔍 Buscar Productos
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Footer Simple -->
    <footer class="mt-auto bg-verde-bosque text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="font-heading text-lg font-bold">AGROSHARE</p>
            <p class="text-sm opacity-80 mt-1">Hecho en Nicaragua 🇳🇮 • Impulsando el comercio agrícola justo</p>
        </div>
    </footer>

</body>
</html>