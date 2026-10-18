import AmbientBackground from './components/AmbientBackground';
import Navbar from './components/Navbar';
import Footer from './components/Footer';
import Hero from './sections/Hero';
import CurrentlyBuilding from './sections/CurrentlyBuilding';
import WolfClient from './sections/WolfClient';
import TechStack from './sections/TechStack';
import Journey from './sections/Journey';
import Setup from './sections/Setup';
import Achievements from './sections/Achievements';
import BirthdayPopup from './components/BirthdayPopup';

export default function App() {
  return (
    <>
      <AmbientBackground />
      <Navbar />
      <BirthdayPopup /> {/* <--- این خط رو جا انداخته بودی داداش! */}
      <main className="relative">
        <Hero />
        <CurrentlyBuilding />
        <WolfClient />
        <TechStack />
        <Journey />
        <Setup />
        <Achievements />
      </main>
      <Footer />
    </>
  );
}