const scratchWin = document.getElementById("scratch-win");
const coin = document.getElementById("coin");
const canvas = document.getElementById("canvas");

// Verificar si todos los elementos necesarios están definidos
if (!scratchWin || !coin || !canvas) {
  console.error("No se pudieron encontrar todos los elementos necesarios.");
} else {
  const ctx = canvas.getContext("2d");

  const width = 320;
  const height = 160;

  // Paint golden gradient
  canvas.width = width;
  canvas.height = height;

  const gradient = ctx.createLinearGradient(0, 0, width, height);

  gradient.addColorStop(0, "#d4af37");
  gradient.addColorStop(0.3, "#a67c00");
  gradient.addColorStop(0.5, "#d4af37");
  gradient.addColorStop(0.8, "#a67c00");
  gradient.addColorStop(1, "#d4af37");

  ctx.fillStyle = gradient;
  ctx.fillRect(0, 0, width, height);

  scratchWin.classList.add("scratch-win--ready");

  // Calculate transparency
  const confetti = document.getElementById("confetti");
  const maxPixels = width * height;

  const calculateTransparency = () => {
    const imageData = ctx.getImageData(0, 0, width, height).data;
    const alphaValues = imageData.filter(
      (value, index) => index % 4 === 3 && value === 0
    );

    return alphaValues.length / maxPixels;
  };

  let isDragging = false;

  const startDragging = (event) => {
    event.preventDefault();
    isDragging = true;
    const clientX = event.clientX || event.touches[0].clientX;
    const clientY = event.clientY || event.touches[0].clientY;

    const coinPosition = coin.getBoundingClientRect();
    const offsetX = clientX - coinPosition.left;
    const offsetY = clientY - coinPosition.top;

    const moveCoin = (event) => {
      if (!isDragging) return;
      const clientX = event.clientX || event.touches[0].clientX;
      const clientY = event.clientY || event.touches[0].clientY;

      coin.style.top = `${clientY - offsetY}px`;
      coin.style.left = `${clientX - offsetX}px`;
    };

    const stopDragging = () => {
      isDragging = false;
      document.removeEventListener("mousemove", moveCoin);
      document.removeEventListener("touchmove", moveCoin);
      document.removeEventListener("mouseup", stopDragging);
      document.removeEventListener("touchend", stopDragging);
    };

    document.addEventListener("mousemove", moveCoin);
    document.addEventListener("touchmove", moveCoin);
    document.addEventListener("mouseup", stopDragging);
    document.addEventListener("touchend", stopDragging);
  };

  coin.addEventListener("mousedown", startDragging);
  coin.addEventListener("touchstart", startDragging);

  const mouseFunction = (event) => {
    if (!isDragging) {
      // Evitar el rascado si no estás arrastrando la moneda
      return;
    }

    // Scratch
    const clientX = event.clientX || event.touches[0].clientX;
    const clientY = event.clientY || event.touches[0].clientY;

    const canvasPosition = canvas.getBoundingClientRect();
    const canvasX = clientX - canvasPosition.left;
    const canvasY = clientY - canvasPosition.top;

    if (canvasX > 0 && canvasX < width && canvasY > 0 && canvasY < height) {
      ctx.clearRect(canvasX - 10, canvasY - 10, 20, 20);

      if (calculateTransparency() > 0.6) {
        confetti.classList.add("confetti--active");
      }
    }
  };

  // In a real life example you should throttle these
  window.addEventListener("mousemove", mouseFunction);
  window.addEventListener("touchmove", mouseFunction);
}
