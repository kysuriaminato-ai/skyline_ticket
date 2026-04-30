            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Highlight active menu item
        const currentUrl = window.location.pathname;
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            if (link.href.includes(currentUrl)) {
                link.style.background = 'var(--sidebar-hover)';
                link.style.borderLeft = '4px solid #3498db';
                link.style.paddingLeft = '16px';
            }
        });
    </script>
</body>
</html>
