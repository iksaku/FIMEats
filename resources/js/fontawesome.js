import { library, dom } from "@fortawesome/fontawesome-svg-core";
import {faChevronDown, faUserSecret} from "@fortawesome/free-solid-svg-icons";
import { faGithub } from "@fortawesome/free-brands-svg-icons";

library.add(faUserSecret, faGithub, faChevronDown);

dom.i2svg();
