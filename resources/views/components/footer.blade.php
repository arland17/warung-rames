<footer class="bg-yellow-400 text-black py-8">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Section 1: Dining Options -->
        <div>
            <h3 class="font-bold mb-4">Dine in &bull; Call in</h3>
            <a href="" class="hover:underline cursor-pointer">Order Online</a>
        </div>

        <!-- Section 2: Location -->
        <div>
            <h3 class="font-bold mb-4">LOCATION</h3>
            <p>Ruko South Goldfinch SGD No.18,<br>Gading Serpong</p>
        </div>

        <!-- Section 3: Explore -->
        <div>
            <h3 class="font-bold mb-4">EXPLORE</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('user.dashboard') }}" class="hover:underline cursor-pointer">Home</a></li>
                <li><a href="{{ route('user.order') }}" class="hover:underline cursor-pointer">Order</a></li>
                <li><a href="{{ route('order.details') }}" class="hover:underline cursor-pointer">History</a></li>
            </ul>
        </div>

        <!-- Section 4: Social Media & Map -->
        <div class="text-center">
            <h3 class="font-bold mb-4">SOCIAL MEDIA</h3>
            <div class="flex justify-center space-x-4 mb-4">
                <a href="#">
                    <img src="{{ asset('img/twitter.png') }}" alt="Twitter" class="w-8 h-8">
                </a>
                <a href="#">
                    <img src="{{ asset('img/facebook.png') }}" alt="Facebook" class="w-8 h-8">
                </a>
                <a href="#">
                    <img src="{{ asset('img/instagram.png') }}" alt="Instagram" class="w-8 h-8">
                </a>
                <a href="#">
                    <img src="{{ asset('img/location.png') }}" alt="Location" class="w-8 h-8">
                </a>
            </div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.645051894105!2d106.61579831567814!3d-6.229572995488595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4201d31eb99e29%3A0x7bb51d3a6046c7b1!2sWarung%20Rame&#39;s!5e0!3m2!1sen!2sid!4v1638507224108!5m2!1sen!2sid"
                width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="border-t mt-8 pt-4 text-center font-semibold text-sm">
        &copy; 2024 WARUNG RAME'S
    </div>
</footer>
