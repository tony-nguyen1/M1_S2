package example;

public aspect Mesure {
	pointcut mesure():
		call (* Calcul.calcul(int));
	
	void around(): mesure() {  
		long start2 = System.nanoTime();
		proceed();
		long end2 = System.nanoTime();
		System.out.println("Elapsed Time in milli seconds: "+ (end2-start2));
//		return 0;
	}
}
