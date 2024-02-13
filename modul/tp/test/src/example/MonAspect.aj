package example;

import org.aspectj.lang.ProceedingJoinPoint;

public aspect MonAspect {
	
	private static boolean flag = false;
	
	public static boolean testAndClear() {
		boolean result = flag; 
		flag = false; 
		return result; 
	}
	
	pointcut moves():
		call(void Line.setP1(Point)) ||
		call(void Line.setP2(Point));
	
	after(): moves() {
		flag = true;
	}
	
	
	
//	void arround() : moves() {
//		
//		long start2 = System.currentTimeMillis();
//		proceed();
//		long end2 = System.currentTimeMillis();
//		System.out.println("Elapsed Time in milli seconds: "+ (end2-start2));

//	}

}
