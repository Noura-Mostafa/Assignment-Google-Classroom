// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging , getToken , onMessage } from "firebase/messaging";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyBDPHluxzm55GxCNgKpcrjWNQzKR9FgPwM",
  authDomain: "classroom-clone-bfeb9.firebaseapp.com",
  projectId: "classroom-clone-bfeb9",
  storageBucket: "classroom-clone-bfeb9.appspot.com",
  messagingSenderId: "612140338083",
  appId: "1:612140338083:web:c8d2784ced04327f8ea816"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

const messaging = getMessaging();
// Add the public key generated from the console here.
getToken(messaging, {
    vapidKey: "BPQQrf5-_fy6asZSlEN2aUwFTeMm9LcJGyHwXV--gTuQiFDJwkazOGWA1RJJ7Ba2rsE_cJVPE75rB6aa17mjfjM"
}).then((currentToken) => {
    if (currentToken) {
        $.post('/api/v1/devices' , {
            _token: "{{ csrf_token() }}",
            token: currentToken
          }, () => {})
    } else {
      // Show permission request UI
      console.log('No registration token available. Request permission to generate one.');
      // ...
    }
  }).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    // ...
  });