// components/module3D.js
import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader';

document.querySelectorAll('[data-model]').forEach((container) => {
  const modelUrl = container.getAttribute('data-model');
  if (!modelUrl) return;

  const scene = new THREE.Scene();

  const camera = new THREE.PerspectiveCamera(
    75,
    container.clientWidth / container.clientHeight,
    0.1,
    1000
  );
  camera.position.set(0, 1, 3);

  const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
  renderer.setSize(container.clientWidth, container.clientHeight);
  container.appendChild(renderer.domElement);

  const controls = new OrbitControls(camera, renderer.domElement);
  controls.enableDamping = true;
  controls.enablePan = false;
  controls.enableZoom = false;
  controls.minPolarAngle = 0;
  controls.maxPolarAngle = Math.PI;

  scene.add(new THREE.HemisphereLight(0xffffff, 0x444444, 1));
  scene.add(new THREE.AmbientLight(0xffffff, 1));

  const dirLight1 = new THREE.DirectionalLight(0xffffff, 0.8);
  dirLight1.position.set(5, 10, 7);
  scene.add(dirLight1);

  const dirLight2 = new THREE.DirectionalLight(0xffffff, 0.6);
  dirLight2.position.set(-5, 5, -7);
  scene.add(dirLight2);

  const loader = new GLTFLoader();
  loader.load(
    modelUrl,
    (gltf) => {
      const model = gltf.scene;

      // Получаем масштаб из data-атрибута
      const scaleAttr = container.getAttribute('data-model-scale');
      const scale = parseFloat(scaleAttr) || 1;
      model.scale.set(scale, scale, scale);

      model.traverse((child) => {
        if (child.isMesh) {
          const materials = Array.isArray(child.material)
            ? child.material
            : [child.material];
          materials.forEach((material) => {
            material.side = THREE.DoubleSide;
            material.needsUpdate = true;
            if ('roughness' in material) material.roughness = 0.4;
            if ('metalness' in material) material.metalness = 0.2;
          });
        }
      });

      scene.add(model);

      const box = new THREE.Box3().setFromObject(model);
      const center = box.getCenter(new THREE.Vector3());
      model.position.sub(center);

      camera.position.set(0, 1, 3);
      controls.target.set(0, 0, 0);
      controls.update();

      animate();
    },
    undefined,
    (error) => {
      console.error(`Ошибка загрузки модели ${modelUrl}:`, error);
    }
  );

  function animate() {
    requestAnimationFrame(animate);
    controls.update();
    renderer.render(scene, camera);
  }

  window.addEventListener('resize', () => {
    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(container.clientWidth, container.clientHeight);
  });
});
