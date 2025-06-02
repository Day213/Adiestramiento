<?php
$logoPath = realpath(__DIR__ . '/../images/logo.png');
$logoPath = $logoPath ? str_replace($_SERVER['DOCUMENT_ROOT'], '', $logoPath) : '/adiestramiento/images/logo.png';
?>

<header class="top-5 absolute flex justify-between items-center p-4 w-full">
  <a href="/adiestramiento">
    <img src="<?php echo $logoPath ?>" alt="Logo" class="mr-4 w-auto h-20" />
  </a>
  <nav>
    <ul class="flex space-x-4">
      <li><a href="/adiestramiento" class="hover:underline">Home</a></li>
      <li><a href="/adiestramiento/login" class="hover:underline">login</a></li>
      <!-- <li><a href="#contact" class="hover:underline">Contact</a></li> -->
    </ul>
  </nav>
</header>