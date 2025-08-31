document.addEventListener('DOMContentLoaded', function() {
	const menuItems = document.querySelectorAll('.menu-item');
	
	 menuItems.forEach(item => {
        const parent = item.querySelector('.menu-item-parent');
        const arrow = parent.querySelector('.arrow i');

        parent.addEventListener('click', function(e) {
            const isCollapsed = document.body.classList.contains('sidebar-collapsed');

            if (isCollapsed) {
                // En modo colapsado, solo alternar el menú actual
                item.classList.toggle('open');
            } else {
                // En modo expandido, cerrar otros y abrir el actual
                menuItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('open');
                        const otherArrow = otherItem.querySelector('.arrow i');
                        if (otherArrow) otherArrow.textContent = 'chevron_right';
                    }
                });
                item.classList.toggle('open');
                if (arrow) arrow.textContent = item.classList.contains('open') ? 'expand_more' : 'chevron_right';
            }
        });
    });
	
	// Abrir el primer menú por defecto
	if (menuItems.length > 0) {
		menuItems[0].classList.add('open');
		const firstArrow = menuItems[0].querySelector('.arrow i');
		firstArrow.textContent = 'expand_more';
	}
});