<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar con Menú Desplegable</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: #f5f6fa;
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            background: #1a1a2e;
            color: #e0e0e0;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px 0;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
            /* Habilitar scroll vertical */
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Ocultar scrollbar pero mantener funcionalidad (opcional) */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h3 {
            color: #4cc9f0;
            font-weight: 500;
            font-size: 20px;
            display: flex;
            align-items: center;
        }

        .sidebar-header i {
            margin-right: 10px;
            font-size: 24px;
        }

        .menu-item {
            position: relative;
            margin-bottom: 5px;
        }

        .menu-item-parent {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            color: #4cc9f0;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 15px;
            position: relative;
            border-left: 3px solid transparent;
        }

        .menu-item-parent:hover {
            background: rgba(76, 201, 240, 0.1);
            border-left-color: #4cc9f0;
        }

        .menu-item-parent.active {
            background: rgba(76, 201, 240, 0.15);
            border-left-color: #4cc9f0;
        }

        .menu-item-parent .material-icons {
            margin-right: 12px;
            font-size: 20px;
        }

        .menu-item-parent .arrow {
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        .menu-item-parent.open .arrow {
            transform: rotate(-90deg);
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .menu-item.open .submenu {
            max-height: 500px;
        }

        .submenu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px 12px 60px;
            color: #a9b1d2;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            border-left: 2px solid transparent;
        }

        .submenu-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            border-left-color: #667eea;
        }

        .submenu-item .material-icons {
            margin-right: 10px;
            font-size: 16px;
            opacity: 0.8;
        }

        .content {
            margin-left: 280px;
            padding: 40px;
            flex: 1;
        }

        .content-header {
            margin-bottom: 30px;
        }

        .content-header h1 {
            color: #1a1a2e;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .content-header p {
            color: #666;
            font-size: 16px;
        }
		
		@font-face {
		  font-family: 'Material Icons';
		  font-style: normal;
		  font-weight: 400;
		  src: url(/css/fonts/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
		}

		.material-icons {
		  font-family: 'Material Icons';
		  font-weight: normal;
		  font-style: normal;
		  font-size: 24px;
		  line-height: 1;
		  letter-spacing: normal;
		  text-transform: none;
		  display: inline-block;
		  white-space: nowrap;
		  word-wrap: normal;
		  direction: ltr;
		  -webkit-font-feature-settings: 'liga';
		  -webkit-font-smoothing: antialiased;
		}

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 15px 0;
            }

            .sidebar-header h3, .menu-item-parent span, .submenu-item {
                display: none;
            }

            .sidebar-header h3::after {
                content: "Menu";
                display: block;
                font-size: 12px;
                color: #a9b1d2;
                margin-top: 5px;
            }

            .menu-item-parent .material-icons {
                margin-right: 0;
                font-size: 22px;
            }

            .menu-item-parent .arrow {
                display: none;
            }

            .content {
                margin-left: 70px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>
                <i class="material-icons">dashboard</i>
                Sistema de Gestión
            </h3>
        </div>

        <div class="menu-container">
            <!-- Home -->
            <div class="menu-item">
                <div class="menu-item-parent">
                    <span>
                        <i class="material-icons">home</i>
                        Home
                    </span>
                    <span class="arrow">
                        <i class="material-icons">chevron_right</i>
                    </span>
                </div>
                <div class="submenu">
                    <div class="submenu-item">
                        <i class="material-icons">dashboard</i>
                        Dashboard
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">analytics</i>
                        Estadísticas
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">insights</i>
                        Reportes
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">calendar_today</i>
                        Agenda
                    </div>
                </div>
            </div>
			
			<!-- Configuración -->
            <div class="menu-item">
                <div class="menu-item-parent">
                    <span>
                        <i class="material-icons">settings</i>
                        Configuración
                    </span>
                    <span class="arrow">
                        <i class="material-icons">chevron_right</i>
                    </span>
                </div>
                <div class="submenu">
                    <div class="submenu-item">
                        <i class="material-icons">security</i>
                        Permisos
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">backup</i>
                        Backup
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">restore</i>
                        Restaurar
                    </div>
                </div>
            </div>
			
			<!-- Usuarios -->
            <div class="menu-item">
                <div class="menu-item-parent">
                    <span>
                        <i class="material-icons">account_circle</i>
                        Usuarios
                    </span>
                    <span class="arrow">
                        <i class="material-icons">chevron_right</i>
                    </span>
                </div>				
                <div class="submenu">
                    <div class="submenu-item">
                        <i class="material-icons">manage_accounts</i>
                        Administradores
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">people</i>
                        Usuarios
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">assignment_ind</i>
                        Empleados
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">car_repair</i>
                        Clientes
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">groups</i>
                        Transportistas
                    </div>
                </div>
            </div>            

            <!-- Productos -->
            <div class="menu-item">
                <div class="menu-item-parent">
                    <span>
                        <i class="material-icons">inventory</i>
                        Productos
                    </span>
                    <span class="arrow">
                        <i class="material-icons">chevron_right</i>
                    </span>
                </div>
                <div class="submenu">
                    <div class="submenu-item">
                        <i class="material-icons">category</i>
                        Categorías
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">local_offer</i>
                        Precios
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">barcode</i>
                        Códigos
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">compare_arrows</i>
                        Traslados
                    </div>
                </div>
            </div>

            <!-- Compras -->
            <div class="menu-item">
                <div class="menu-item-parent">
                    <span>
                        <i class="material-icons">shopping_cart</i>
                        Compras
                    </span>
                    <span class="arrow">
                        <i class="material-icons">chevron_right</i>
                    </span>
                </div>
                <div class="submenu">
                    <div class="submenu-item">
                        <i class="material-icons">add_shopping_cart</i>
                        Nueva Compra
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">receipt</i>
                        Facturas
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">local_shipping</i>
                        Proveedores
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">history</i>
                        Histórico
                    </div>
                </div>
            </div>

            <!-- Ventas -->
            <div class="menu-item">
                <div class="menu-item-parent">
                    <span>
                        <i class="material-icons">store</i>
                        Ventas
                    </span>
                    <span class="arrow">
                        <i class="material-icons">chevron_right</i>
                    </span>
                </div>
                <div class="submenu">
                    <div class="submenu-item">
                        <i class="material-icons">point_of_sale</i>
                        Punto de Venta
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">credit_card</i>
                        Facturación
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">person</i>
                        Clientes
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">trending_up</i>
                        Metas
                    </div>
                </div>
            </div>

            <!-- Almacén -->
            <div class="menu-item">
                <div class="menu-item-parent">
                    <span>
                        <i class="material-icons">warehouse</i>
                        Almacén
                    </span>
                    <span class="arrow">
                        <i class="material-icons">chevron_right</i>
                    </span>
                </div>
                <div class="submenu">
                    <div class="submenu-item">
                        <i class="material-icons">inventory_2</i>
                        Existencias
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">sync_alt</i>
                        Entradas/Salidas
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">warning</i>
                        Stock Mínimo
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">inventory</i>
                        Inventario
                    </div>
                </div>
            </div>

            <!-- Caja -->
            <div class="menu-item">
                <div class="menu-item-parent">
                    <span>
                        <i class="material-icons">account_balance_wallet</i>
                        Caja
                    </span>
                    <span class="arrow">
                        <i class="material-icons">chevron_right</i>
                    </span>
                </div>
                <div class="submenu">
                    <div class="submenu-item">
                        <i class="material-icons">attach_money</i>
                        Apertura
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">money_off</i>
                        Arqueo
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">payment</i>
                        Formas de Pago
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">receipt_long</i>
                        Movimientos
                    </div>
                </div>
            </div>

            <!-- Más items para forzar scroll (opcional para pruebas) -->
            <div class="menu-item">
                <div class="menu-item-parent">
                    <span>
                        <i class="material-icons">report</i>
                        Reportes
                    </span>
                    <span class="arrow">
                        <i class="material-icons">chevron_right</i>
                    </span>
                </div>
                <div class="submenu">
                    <div class="submenu-item">
                        <i class="material-icons">insert_chart</i>
                        Ventas Diarias
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">assessment</i>
                        Margen de Ganancia
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <div class="menu-item-parent">
                    <span>
                        <i class="material-icons">help</i>
                        Ayuda
                    </span>
                    <span class="arrow">
                        <i class="material-icons">chevron_right</i>
                    </span>
                </div>
                <div class="submenu">
                    <div class="submenu-item">
                        <i class="material-icons">question_answer</i>
                        Soporte
                    </div>
                    <div class="submenu-item">
                        <i class="material-icons">info</i>
                        Acerca de
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="content-header">
            <h1>Sistema de Gestión</h1>
            <p>Selecciona una opción del menú lateral para comenzar</p>
        </div>
        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
            <h2 style="color: #1a1a2e; margin-bottom: 15px;">Panel de Control</h2>
            <p style="color: #666; line-height: 1.6;">
                Bienvenido al sistema de gestión. Utiliza el menú lateral para navegar entre las diferentes 
                secciones del sistema. Cada módulo contiene funcionalidades específicas para la administración 
                de tu negocio.
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.menu-item');
            
            menuItems.forEach(item => {
                const parent = item.querySelector('.menu-item-parent');
                const arrow = parent.querySelector('.arrow i');
                
                parent.addEventListener('click', function(e) {
                    // Alternar clase open
                    item.classList.toggle('open');
                    
                    // Cambiar el icono según el estado
                    if (item.classList.contains('open')) {
                        arrow.textContent = 'expand_more';
                    } else {
                        arrow.textContent = 'chevron_right';
                    }
                    
                    // Cerrar otros menús
                    menuItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('open')) {
                            otherItem.classList.remove('open');
                            const otherArrow = otherItem.querySelector('.arrow i');
                            otherArrow.textContent = 'chevron_right';
                        }
                    });
                });
            });

            // Abrir el primer menú por defecto
            if (menuItems.length > 0) {
                menuItems[0].classList.add('open');
                const firstArrow = menuItems[0].querySelector('.arrow i');
                firstArrow.textContent = 'expand_more';
            }
        });
    </script>
</body>
</html>