package example;

public class App {

	public static void main(String[] args) {
		Line l1,l2;
		
		l1 = new Line();
		
		Point p1 = new Point();
		Point p2 = new Point();
		
		System.out.println("before: hasMoved? " + MonAspect.testAndClear());
		
		l1.setP1(p1);l1.setP2(p2);
		
		System.out.println("after: hasMoved? " + MonAspect.testAndClear());
		
		new Calcul().calcul(10000000);

	}

}
