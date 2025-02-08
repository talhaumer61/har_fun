        @include("site.components.modals.delete_account.confirm_modal")
		<button class="scroll-top">
			<i class="bi bi-arrow-up-short"></i>
		</button>




		<!-- Optional JavaScript _____________________________  -->

		<!-- jQuery first, then Bootstrap JS -->
		<!-- jQuery -->
		<script src="{{asset('site/vendor/jquery.min.js')}}"></script>
		<!-- Bootstrap JS -->
		<script src="{{asset('site/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- WOW js -->
		<script src="{{asset('site/vendor/wow/wow.min.js')}}"></script>
		<!-- Slick Slider -->
		<script src="{{asset('site/vendor/slick/slick.min.js')}}"></script>
		<!-- Fancybox -->
		<script src="{{asset('site/vendor/fancybox/dist/jquery.fancybox.min.js')}}"></script>
		<!-- Lazy -->
		<script src="{{asset('site/vendor/jquery.lazy.min.js')}}"></script>
		<!-- js Counter -->
		<script src="{{asset('site/vendor/jquery.counterup.min.js')}}"></script>
		<script src="{{asset('site/vendor/jquery.waypoints.min.js')}}"></script>
		<!-- Nice Select -->
		<script src="{{asset('site/vendor/nice-select/jquery.nice-select.min.js')}}"></script>
		<!-- validator js -->
		<script src="{{asset('site/vendor/validator.js')}}"></script>

		<!-- Theme js -->
		<script src="{{asset('site/js/theme.js')}}"></script>
		{{-- Show Password --}}
		<script>
			document.querySelectorAll(".passVicon").forEach(icon => {
				icon.addEventListener("click", function() {
					let passwordField = document.getElementById("password");
					let confirmPasswordField = document.getElementById("confirmPassword");
					
					// Toggle visibility
					if (passwordField.type === "password") {
						passwordField.type = "text";
						confirmPasswordField.type = "text";
					} else {
						passwordField.type = "password";
						confirmPasswordField.type = "password";
					}
				});
			});
		</script>
		
		
		
		{{-- Check Username & Email Availability, Validate Password(Length & Confirm Password ) --}}
		<script>
			function checkAvailability(field, type) {
				let value = field.value.trim();
				let errorElement = document.getElementById(type + "Error");
		
				if (value === "") {
					errorElement.textContent = "";
					return;
				}
		
				if (value.length < 3) {
					errorElement.textContent = type.charAt(0).toUpperCase() + type.slice(1) + " must be at least 3 characters.";
					return;
				}
		
				fetch("/check-user", {
					method: "POST",
					headers: {
						"Content-Type": "application/json",
						"X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
					},
					body: JSON.stringify({ type: type, value: value })
				})
				.then(response => response.json())
				.then(data => {
					errorElement.textContent = data.exists ? (type.charAt(0).toUpperCase() + type.slice(1) + " is already taken.") : "";
				})
				.catch(error => console.error("Error:", error));
			}
		
			document.getElementById("email").addEventListener("input", function() {
				checkAvailability(this, "email");
			});
		
			document.getElementById("username").addEventListener("input", function() {
				checkAvailability(this, "username");
			});
		
			document.getElementById("signupForm").addEventListener("submit", function(event) {
				let password = document.getElementById("password").value;
				let confirmPassword = document.getElementById("confirmPassword").value;
				let passwordError = document.getElementById("passwordError");
				let confirmPasswordError = document.getElementById("confirmPasswordError");
		
				passwordError.textContent = "";
				confirmPasswordError.textContent = "";
		
				let isValid = true;
		
				if (password.length < 8) {
					passwordError.textContent = "Password must be at least 8 characters long.";
					isValid = false;
				}
		
				if (password !== confirmPassword) {
					confirmPasswordError.textContent = "Passwords do not match.";
					isValid = false;
				}
		
				if (!isValid) {
					event.preventDefault();
				}
			});
		</script>
		
		

	</div> <!-- /.main-page-wrapper -->
</body>


</html>